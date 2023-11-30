<x-app-layout>
    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
        <div class="flex flex-wrap mb-12">
            <div class="w-full flex justify-start md:w-1/3 mb-8 md:mb-0">
                <img class="h-full rounded-l-sm" src="{{ $hotel->getPoster_url() }}" alt="Room Image">
            </div>
            <div class="w-full md:w-2/3 px-4">
                <div class="text-2xl font-bold">{{ $hotel->getTitle() }}</div>
                <div class="flex items-center">
                    {{ $hotel->getAddress() }}
                </div>
                <div>{{ $hotel->getDescription() }}</div>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="text-3xl text-center md:text-start font-bold">Забронировать комнату</div>
            <form method="get" action="{{ url()->current() }}">
                <div class="flex my-6">
                    <div class="text-xl ">Удобства:</div>
                    <div>
                        @foreach($hotel->getRoomFacilities() as $facility)
                                <input class="ml-4" type="checkbox" name="filters[]" value="{{$facility->id}}">
                                <label for="{{$facility->id}}">{{$facility->title}}</label>
                        @endforeach
                    </div>
                </div>
                <div class="flex my-6">
                    <div class="flex items-center mr-5">
                        <div class="relative">
                            <input name="start_date" min="{{ date('Y-m-d') }}" value="{{ $hotel->getStart_date() }}"
                                   placeholder="Дата заезда" type="date"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                        </div>
                        <span class="mx-4 text-gray-500">по</span>
                        <div class="relative">
                            <input name="end_date" type="date" min="{{ date('Y-m-d') }}" value="{{ $hotel->getEnd_date() }}"
                                   placeholder="Дата выезда"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                        </div>
                    </div>
                    <div class="flex mx-4">
                        <select name="sort">
                            <option selected name="sort" value="title_asc">Сортировать по:</option>
                            <option name="sort" value="title_asc">Алфавиту&uarr;</option>
                            <option name="sort" value="price_asc">Цене&uarr;</option>
                            <option name="sort" value="type_asc">Типу&uarr;</option>
                            <option name="sort" value="title_desc">Алфавиту&#8595</option>
                            <option name="sort" value="price_desc">Цене&#8595</option>
                            <option name="sort" value="type_desc">Типу&#8595</option>
                        </select>
                    </div>
                    <div>
                        <x-the-button type="submit" class=" h-full w-full">Загрузить номера</x-the-button>
                    </div>
                </div>
            </form>
                <div class="flex flex-col w-full lg:w-4/5">
                    @foreach($hotel->getFilterRooms() as $room)
                            <x-rooms.room-list-item :room="$room" class="mb-4"/>
                    @endforeach
                </div>
        </div>
    </div>
</x-app-layout>
