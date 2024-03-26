<div class="flex">
    <div>
       <x-secondary-button>
            <a href="{{ route('adverts.index', ['filter' => 'sale']) }}">Buy</a>
        </x-secondary-button>
        <x-secondary-button>
            <a href="{{ route('adverts.index', ['filter' => 'rental']) }}">Rent</a>
        </x-secondary-button>
        <x-secondary-button>
            <a href="{{ route('adverts.index', ['filter' => 'auction']) }}">Auction</a>
        </x-secondary-button>  
        <form action="{{ route('adverts.index') }}" method="GET">
            <input type="text" name="search" placeholder="Search...">
            <button type="submit">Search</button>
        </form> 
    </div>

</div>
