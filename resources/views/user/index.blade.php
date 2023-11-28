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
                    <h2 class="text-2xl mb-8 text-center w-full px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-white">~ 商品一覧 ~</h2>
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

  <div class="py-4 mt-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
           <section class="text-gray-600 body-font">
              <div class="container mx-auto px-5 py-6">
                  <div class="md:flex">

                    <div class="md:w-5/12">
                        <section class="text-gray-600 body-font">
                            <div class="container px-5 mx-auto">
                              <div class="flex flex-col text-center w-full mb-20">
                                
                                <h2 class=" text-indigo-500 tracking-widest font-medium title-font mb-6">〜美味しいラーメンをご自宅で〜</h2>
                                <img src="{{"/images/logo.jpg"}}" class="w-40 mb-8 mx-auto" alt="Flowbite Logo" />
                                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">当サイトについて</h1>
                                <p class="lg:w-full mx-auto leading-relaxed text-base">ラーメンデリバリーでは、日本中の美味しいラーメンをネットで簡単に注文できます。厳選な審査に合格したお店のみ出店しているため、美味しいラーメンをご自宅で楽しむことができます。
                                </p>
                              </div>
                            </div>
                          </section>
                    </div>

                    <div class="md:w-7/12">
                        <section class="text-gray-600 body-font">
                            <div class="container px-5 mx-auto flex flex-wrap">
                              <div class="flex relative pt-5 pb-10 sm:items-center md:w-2/3 mx-auto">
                                <div class="h-full w-6 absolute inset-0 flex items-center justify-center">
                                  <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                                </div>
                                <div class="flex-shrink-0 w-6 h-6 rounded-full mt-10 sm:mt-0 inline-flex items-center justify-center bg-indigo-500 text-white relative z-10 title-font font-medium text-sm">1</div>
                                <div class="flex-grow md:pl-8 pl-6 flex sm:items-center items-start flex-col sm:flex-row">
                                  <div class="flex-grow sm:pl-6 mt-6 sm:mt-0">
                                    <h2 class="font-medium title-font text-gray-900 mb-1 text-xl">新規登録</h2>
                                    <p class="leading-relaxed">商品の購入には新規登録が必要です。登録済みの場合はログインしてください。</p>
                                  </div>
                                </div>
                              </div>
                              <div class="flex relative pb-10 sm:items-center md:w-2/3 mx-auto">
                                <div class="h-full w-6 absolute inset-0 flex items-center justify-center">
                                  <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                                </div>
                                <div class="flex-shrink-0 w-6 h-6 rounded-full mt-10 sm:mt-0 inline-flex items-center justify-center bg-indigo-500 text-white relative z-10 title-font font-medium text-sm">2</div>
                                <div class="flex-grow md:pl-8 pl-6 flex sm:items-center items-start flex-col sm:flex-row">
                                  <div class="flex-grow sm:pl-6 mt-6 sm:mt-0">
                                    <h2 class="font-medium title-font text-gray-900 mb-1 text-xl">商品を選択</h2>
                                    <p class="leading-relaxed">商品の画像をクリックすると商品の詳細を確認できます。気に入った商品があれば、カートに追加してください。</p>
                                  </div>
                                </div>
                              </div>
                              <div class="flex relative sm:items-center md:w-2/3 mx-auto">
                                <div class="h-full w-6 absolute inset-0 flex items-center justify-center">
                                  <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                                </div>
                                <div class="flex-shrink-0 w-6 h-6 rounded-full mt-10 sm:mt-0 inline-flex items-center justify-center bg-indigo-500 text-white relative z-10 title-font font-medium text-sm">3</div>
                                <div class="flex-grow md:pl-8 pl-6 flex sm:items-center items-start flex-col sm:flex-row">
                                  <div class="flex-grow sm:pl-6 mt-6 sm:mt-0">
                                    <h2 class="font-medium title-font text-gray-900 mb-1 text-xl">決済処理</h2>
                                    <p class="leading-relaxed">カートの「購入する」のボタンから決済処理が行えます。決済後、登録先の住所に商品が届きます。</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </section>
                    </div>
                      
                  </div>
              </div>
           </section>
        </div>
    </div>
</div>
</x-app-layout>
