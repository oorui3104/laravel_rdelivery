<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          カート
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                <x-flash-message class="text-center mb-8" />
                  @foreach ($products as $product)
                      <div class="md:flex md:justify-around md:items-center mb-8">
                        <div class="md:w-4/12 mt-4">
                           @if (!is_null($product->imageFirst) && !is_null($product->imageFirst->filename))
                            <img alt="" class="object-contain object-center w-full h-full block" src="{{ asset('/storage/products/' . $product->imageFirst->filename) }}">
                           @else
                            <img alt="" class="object-contain object-center w-full h-full block" src="{{ asset('/images/no_image.jpg') }}">
                           @endif
                        </div>
                        <div class="md:w-2/12 md:ml-16">{{ $product['name'] }}</div>
                        <div class="md:w-1/12 md:ml-16">{{ $product->pivot->quantity }}個</div>
                        <div class="md:w-2/12 md:ml-16">{{ number_format($product['price'] * $product->pivot->quantity ) }}円（税込）</div>
                        <div class="md:w-3/12 md:ml-16">
                          <form  action="{{ route('user.carts.delete', ['id' => $product['id']]) }}" method="POST">
                            @csrf
                            <button type="submit" class=" text-white bg-red-500 border-0 py-2 px-2 focus:outline-none hover:bg-red-600 rounded text-lg">カートから削除</button>
                          </form>
                        </div>
                      </div>
                  @endforeach
              </div>
              <div class="md:flex md:justify-end">
                <div>
                  {{ number_format($totalPrice) }}円（税込）
                </div>
                <button>
                  購入する
                </button>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
