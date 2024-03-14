<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;

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
        return $dompdf->stream("service_agreement.pdf", ["Attachment" => false]);
    }
}
