
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-200 flex justify-center items-center">
<div>
{!! QrCode::size(300)->generate(Request::url()) !!}
</div>
</div>