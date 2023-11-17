<x-app-layout>
  <x-slot name="header">
    <div class="flex mx-auto gap-6 justify-between items-center">
      <div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            商品管理
        </h2>
        <p class="mt-3">(商品情報の登録・更新ができます。)</p>
      </div>
      <div>
        <a href="{{ route('owner.products.create') }}">
          <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg mr-12">新規登録</button>
        </a>
      </div>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <section class="text-gray-600 body-font">
            <div class="container mx-auto px-5 py-6">
              <x-flash-message class="text-center" />
              <div class="flex flex-wrap -m-4">
                @foreach ($ownerInfo->shop->product as $product)
                  <div class="lg:w-1/4 md:w-1/2 p-4 mb-20 w-full">
                    <a href="{{ route('owner.products.edit', ['product' => $product['id']]) }}" class="block relative h-48 rounded overflow-hidden">
                      <img alt="" class="object-contain object-center w-full h-full block" src="{{ asset('/storage/products/' . $product->imageFirst->filename) }}">
                    </a>
                    <div class="mt-4">
                      <h2 class="text-gray-900 text-center title-font text-lg font-medium">{{ $product['name'] }}</h2>
                      <p class="mt-1 text-center">{{ $product['price'] }}円</p>
                    </div>
                  </div>  
                @endforeach
              </div>
            </div>
          </section>
        </div>
          <div class="mt-4">
            {{-- {{ $images->links() }} --}}
          </div>
    </div>
</div>
</x-app-layout>
