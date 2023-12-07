<x-app-layout>

    <div class="flex flex-col mx-6">
        <div class="text-3xl text-center md:text-start font-bold">Выбрать отель</div>

        <form method="get" action="{{ url()->current() }}">
            <div class="flex my-6">
                <div class="text-xl ">Удобства:</div>
                <div>
                    @foreach($facilities as $facility)
                        <input class="ml-4" type="checkbox" name="filters[]" value="{{$facility->id}}">
                        <label for="{{$facility->id}}">{{$facility->title}}</label>
                    @endforeach
                </div>
            </div>
            <div class="flex my-6">
                <div class="flex mr-5">
                    <select name="sort">
                        <option selected name="sort" value="title_asc">Сортировать по:</option>
                        <option name="sort" value="title_asc">Алфавиту&uarr;</option>
                        <option name="sort" value="minPrice_asc">Цене&uarr;</option>
                        <option name="sort" value="title_desc">Алфавиту&#8595</option>
                        <option name="sort" value="maxPrice_desc">Цене&#8595</option>
                    </select>
                </div>
                <div>
                    <x-the-button type="submit" class=" h-full w-full">Загрузить отели</x-the-button>
                </div>
            </div>
        </form>
    </div>

    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($hotels as $hotel)
                <x-hotels.hotel-card :hotel="$hotel"></x-hotels.hotel-card>
            @endforeach
        </div>
    </div>
</x-app-layout>
