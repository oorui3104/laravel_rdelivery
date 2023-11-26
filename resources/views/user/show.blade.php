<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      商品情報
    </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="sm:flex sm:gap-8">
                <div class="sm:w-2/3 overflow-hidden">
                    <div class="swiper-container">
                      <div class="swiper-wrapper">
                        <div class="swiper-slide">
                          @if(empty($product->imageFirst->filename))
                            <img class="object-fill" src="{{ asset('/images/no_image.jpg') }}" alt="">
                          @else 
                          <img src="{{ asset('/storage/products/' . $product->imageFirst->filename) }}" alt="">
                          @endif
                        </div>
                        <div class="swiper-slide">
                          @if(empty($product->imageSecound->filename))
                            <img class="object-fill" src="{{ asset('/images/no_image.jpg') }}" alt="">
                          @else 
                          <img src="{{ asset('/storage/products/' . $product->imageSecound->filename) }}" alt="">
                          @endif
                        </div>
                        <div class="swiper-slide">
                          @if(empty($product->ImageThird->filename))
                            <img class="object-fill" src="{{ asset('/images/no_image.jpg') }}" alt="">
                          @else 
                          <img src="{{ asset('/storage/products/' . $product->ImageThird->filename) }}" alt="">
                          @endif
                        </div>
                        <div class="swiper-slide">
                          @if(empty($product->ImageFourth->filename))
                            <img class="object-fill" src="{{ asset('/images/no_image.jpg') }}" alt="">
                          @else 
                          <img src="{{ asset('/storage/products/' . $product->ImageFourth->filename) }}" alt="">
                          @endif
                        </div>
                      </div>
                      <div class="swiper-pagination"></div>
                      <div class="swiper-button-prev"></div>
                      <div class="swiper-button-next"></div>
                      <div class="swiper-scrollbar"></div>
                    </div>
                 </div>
              <div class="sm:w-1/2 p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg"">
                <p class="p-2 text-gray-900 text-xl">{{ $product->shop->name }}</p>
                <p class="p-2 text-gray-900 text-3xl">{{ $product['name'] }}</p>
                <p class="p-2 text-gray-900">{{ $product['information'] }}</p>
                <p class="mt-8 p-2 text-gray-900 text-xl">{{ number_format($product['price']) }} 円（税込）</p>
                 @if (auth('users')->user())
                    <form action="{{ route('user.carts.store', ['id' => $product['id']]) }}" method="POST">
                      @csrf
                      <div class="md:flex justify-between gap-4 items-center  p-2"> 
                          <div class="flex items-center">
                            <span class="mr-3">数量</span>
                            <div class="relative">
                              <select name="quantity" class="rounded border appearance-none border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base pl-3 pr-10">
                                @for ($i = 1; $i < $quantity; $i++ )
                                  <option value="{{ $i }}" >{{ $i }}</option>
                                @endfor
                              </select>
                            </div>
                          </div>
                          <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-6 md:mt-0 mt-4 focus:outline-none hover:bg-indigo-600 rounded">カートに追加</button>
                      </div>
                    </form>
                 @else
                    <p class="p-2 mt-12 text-gray-900 text-sm">※ 商品を購入をご希望の場合、ログイン（新規登録）をしてください。</p>
                 @endif
              </div>
            </div>
          </div>
      </div>
  </div>
</x-app-layout>
