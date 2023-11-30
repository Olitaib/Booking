<div class="bg-white rounded shadow-md flex card text-grey-darkest">
    <img class="w-1/2 h-full rounded-l-sm" src="{{ $hotel->getPoster_url() }}" alt="Hotel Image">
    <div class="w-full flex flex-col justify-between p-4">
        <div>
            <a class="block text-grey-darkest mb-2 font-bold"
               href="{{ route('hotels.show', ['id' => $hotel->getId()]) }}">{{ $hotel->getTitle() }}</a>
            <div class="text-xs">
                {{ $hotel->getAddress() }}
            </div>
        </div>
        <div class="pt-2">
            <span class="text-2xl text-grey-darkest">от {{ $hotel->getRoomMinPrice() }}р.</span>
            <span class="text-lg"> за ночь</span>
        </div>
            <div class="flex items-center py-2">
                @foreach($hotel->getFacilities() as $facility)
                    <div class="pr-2 text-xs">
                        <span>•</span> {{ $facility->title }}
                    </div>
                @endforeach
            </div>
        <div class="flex justify-end">
            <x-link-button href="{{ route('hotels.show', ['id' => $hotel->getId()]) }}">Подробнее</x-link-button>
        </div>
    </div>
</div>
