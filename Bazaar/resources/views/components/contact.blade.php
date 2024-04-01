<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-200">
<div class="p-6 text-gray-900 dark:text-gray-100">
<?php
$url = str_replace('http://127.0.0.1:8000/c/', '', Request::url());
$results = DB::select('select * from companies where custom_url = ?', [$url]);
?>
{{$results[0]->phone}}
<br>
{{$results[0]->email}}
<br>
{{$results[0]->address}}
<br>
{{$results[0]->city}}
<br>
{{$results[0]->country}}
<br>
{{$results[0]->postal_code}}
<br>
</div>
</div>