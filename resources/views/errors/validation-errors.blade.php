<x-app-layout>
    <div class="flex justify-center font-bold">
        <div class="flex-row justify-center">
            @foreach($errors as $error)
                <div class="text-2xl text-gray-600 py-4">Error : {{$error}}</div>
            @endforeach
        </div>
    </div>
</x-app-layout>
