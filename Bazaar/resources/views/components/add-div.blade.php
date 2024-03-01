<div class="flex">
    <div class="w-3/4">
        <a href="{{ route('advert', $advert->id) }}">
            <h1 class="font-bold text-x1"><b>{{ $advert->title }}</b></h1>
            <p>{{ $advert->advertisement_text }}</p>
            <p>Price: €{{ $advert->price }}</p>
            <p>Posted by: {{ $advert->user->name }}</p>
        </a>
    </div>
    <div class="w-1/4">
        <div class="w-100">
            test
        </div>       
    </div>
</div>
