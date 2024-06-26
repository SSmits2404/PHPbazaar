<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Models\Contract;
use App\Models\User;

use function Laravel\Prompts\error;

class ContractController extends Controller
{
    public function generatePDF(Request $request)
    {
        $clientName = $request->input('clientName', 'John Doe'); // Default to 'John Doe' if not provided
        $startDate = now()->toString(); // Use current date as default

        // Prepare the HTML content
        $htmlContent = view('contract', [
            'clientName' => $clientName,
            'start_date' => $startDate,
        ])->render();

        // Initialize and configure Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($htmlContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Stream the generated PDF back to the browser
        return $dompdf->stream("service_agreement.pdf", ["Attachment" => true]);
    }

    public function storecontract(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|file|mimes:pdf|max:2048',
        ]);

        $contract = new Contract();
        $contract->pdf_file = $request->file('pdf_file')->store('contracts');
        $contract->approved = false;
        $contract->subject_user_id = $request['subject'];
        $contract->save();

        return redirect('/');
    }

    public function getcontractupload(Request $request)
    {
        if(!$request->has('subject')) {
            error('Subject is required');
        }
        return view('contractupload', ['subject' => $request['subject']]);
    }
    public function getunapprovedpdf(Request $request)
    {
        $contracts = Contract::where('approved', false)->where('subject_user_id', auth()->id())->orderBy('created_at', 'desc')->first(); 
        $pathToFile = storage_path('app/' . $contracts->pdf_file);
        return response()->download($pathToFile);
    }

    public function approvepdf(Request $request)
    {
        $contract = Contract::where('approved', false)->where('subject_user_id', auth()->id())->orderBy('created_at', 'desc')->first(); 
        $contract->approved = true;
        $contract->save();
        return redirect('/');
    }
}
