<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      店舗情報
    </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="sm:flex sm:gap-8">
              <div class="sm:w-3/5 overflow-hidden">
                  @if(empty($shop['filename']))
                  <img class="object-fill" src="{{ asset('/images/no_image.jpg') }}" alt="">
                  @else 
                  <img src="{{ asset('/storage/shops/' . $shop["filename"]) }}" alt="">
                  @endif
              </div>
              <div class="sm:w-2/5 p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg"">
                <p class="p-2 text-gray-900 text-xl">{{ $shop['name'] }}</p>
                <p class="p-2 text-gray-900">{{ $shop['address'] }}</p>
                <p class="pl-2 text-gray-900">{{ $shop['inquiry'] }}</p>
                <h2 class="p-2 mt-6 text-xl">店舗情報</h2>
                <p class="p-2 text-gray-900">{{ $shop['information'] }}</p>
              </div>
          </div>
          </div>
      </div>
  </div>
</x-app-layout>
