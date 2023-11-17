<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          商品画像管理
      </h2>
      <form action="{{ route('owner.images.store')}}" method="POST" enctype="multipart/form-data" class="w-full mt-4  ">
        @csrf
        <x-input-error :messages="$errors->first('files.*.image')" class="mt-2" />
          <label for="image" class="leading-7 text-sm text-gray-600">商品画像のアップロード(複数可)</label>
          <div class="flex gap-4 justify-start items-center">
            <input type="file" id="image" name="files[][image]" accept="image/*" required multiple class=" bg-white bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 leading-8 transition-colors duration-200 ease-in-out">
            <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg ">登録</button>
          </div>
      </form>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <section class="text-gray-600 body-font">
            <div class="container mx-auto px-5 py-6">
              <x-flash-message class="text-center" />
              <div class="flex flex-wrap -m-4">
                @foreach ($images as $image)
                  <div class="lg:w-1/4 md:w-1/2 p-4 mb-20 w-full">
                    <img alt="" class="object-contain object-center w-full h-full block" src="{{ asset('/storage/products/' . $image["filename"]) }}">
                    <form action="{{ route('owner.images.destroy', ['id' => $image['id']]) }}" method="post" class="mt-4">
                      @csrf
                      <button type="submit" class="flex mx-auto text-white bg-red-500 border-0 py-2 px-12 focus:outline-none hover:bg-red-600 rounded text-lg">削除</button>
                    </form>
                  </div>  
                @endforeach
              </div>
            </div>
          </section>
        </div>
          <div class="mt-4">
            {{ $images->links() }}
          </div>
    </div>
</div>
</x-app-layout>
