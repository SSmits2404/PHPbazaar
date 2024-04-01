<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-200">
<div class="p-6 text-gray-900 dark:text-gray-100">
<?php
$url = str_replace('http://127.0.0.1:8000/c/', '', Request::url());
$results = DB::select('select * from companies where custom_url = ?', [$url]);
?>
{{$results[0]->intro}}
</div>
</div>