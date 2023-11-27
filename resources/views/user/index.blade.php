<x-app-layout>
  {{-- <x-slot name="header">
    
  </x-slot> --}}

  <div class="relative mt-4">
    <h2 class="absolute z-10 leading-tight font-mono text-5xl md:text-7xl text-white top-10 left-20">
        お家で食べる
        <br>
        <span class="mt-6 ml-4 block">
        美味しいラーメン
        </span>
    </h2>
    <div class="absolute inset-0 bg-black opacity-20"></div>
    <img class=" h-60 w-full object-cover" src="{{ asset('/images/sample03.jpeg') }}" alt="">
</div>

  <div class="py-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
             <section class="text-gray-600 body-font">
                <div class="container mx-auto px-5 py-6">
                    <h2 class="text-2xl mb-4 text-center">商品一覧</h2>
                    <div class="flex flex-wrap -m-4">
                        @foreach ($products as $product)
                        <div class="lg:w-1/4 md:w-1/2 p-4 mb-8 w-full">
                            <a href="{{ route('user.items.show', ['id' => $product->productId]) }}" class="block relative h-48 rounded overflow-hidden">
                                @if (!is_null($product->filename) && !is_null($product->filename))
                                    <img alt="" class="object-contain object-center w-full h-full block" src="{{ asset('/storage/products/' . $product->filename) }}">
                                @else
                                    <img alt="" class="object-contain object-center w-full h-full block" src="{{ asset('/images/no_image.jpg') }}">
                                @endif
                            </a>
                            <div>
                                <h2 class="text-indigo-500 text-center title-font text-lg font-medium mt-2"><a href="{{ route('user.items.shop', ['id' => $product->shopId]) }}">販売元：{{ $product->shopName }}</a></h2>
                                <h2 class="text-gray-900 text-center title-font text-lg font-medium mt-2">{{ $product->productName }}</h2>
                                <p class="mt-1 text-center">{{ number_format($product->price) }} 円(税込)</p>
                            </div>
                        </div>  
                        @endforeach
                    </div>
                </div>
             </section>
          </div>
          <div class="mt-4">
            {{ $products->links() }}
          </div>
      </div>
  </div>
</x-app-layout>
