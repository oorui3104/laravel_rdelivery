<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          商品管理
      </h2>
  </x-slot>

  <section class="text-gray-600 body-font relative">
    <div class="container px-5 py-24 mx-auto">
      <div class="flex flex-col text-center w-full mb-12">
        <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">商品情報（編集）</h1>
        <p class="lg:w-2/3 mx-auto leading-relaxed text-base"></p>
      </div>
      <div class="lg:w-1/2 md:w-2/3 mx-auto">
        <form action="{{ route('owner.products.update', ['product' => $product['id']]) }}" method="POST">
          @csrf
          @method('put')
          <div class="p-2">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            <div class="relative">
              <label for="name" class="leading-7 text-sm text-gray-600">商品名(必須)</label>
              <input type="text" id="name" name="name" value="{{ old('name', $product['name']) }}" required class="w-full bg-white-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
          </div>
          <div class="p-2">
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
            <div class="relative">
              <label for="price" class="leading-7 text-sm text-gray-600">価格(必須)</label>
              <input type="text" id="price" name="price" required value="{{ old('price', $product['price']) }}" class="w-full bg-white-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
          </div>
          <div class="p-2">
            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
            <div class="relative">
              <label for="current_quantity" class="leading-7 text-sm text-gray-600">在庫情報</label>
              <div id="current_quantity" class="w-full bg-whitebg-opacity-50 rounde focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700  leading-8 transition-colors duration-200 ease-in-out">
                現在の在庫：{{ $stock }}
              </div>
              <div class="px-3">
                  <input class="" type="radio" name="type" value="1"> 追加する
                  <br>
                  <input type="radio" name="type" value="2"> 削除する
              </div>
              <div class=" mt-2">
                <label for="quantity" class="leading-7 text-sm text-gray-600"></label>
                <input type="number" id="quantity" name="quantity" value='0' min="0" max="99" class="w-full bg-white-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 leading-8 transition-colors duration-200 ease-in-out">
              </div>
            </div>
          </div>
          <div class="p-2 w-full">
            <div class="relative">
              <x-input-error :messages="$errors->get('information')" class="mt-2" />
              <label for="information" class="leading-7 text-sm text-gray-600">商品情報</label>
              <textarea id="information" name="information" class="w-full bg-white-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ old('information', $product['information']) }}</textarea>
            </div>
          </div>
          <div class="p-2">
            <div class="relative bg-white-100">
              <x-input-error :messages="$errors->get('image1')" class="mt-2" />
              <x-input-error :messages="$errors->get('image2')" class="mt-2" />
              <x-input-error :messages="$errors->get('image3')" class="mt-2" />
              <x-input-error :messages="$errors->get('image4')" class="mt-2" />
              <label for="image" class="leading-7 text-sm text-gray-600">商品画像(最大で4つ選択可)</label>
            </div>
          </div>
            <x-select-image :images="$images" name="image1" currentImage="{{$product->imageFirst->filename ?? ''}}" currentImageId="{{$product->image1}}"/>
            <x-select-image :images="$images" name="image2" currentImage="{{$product->imageSecound->filename ?? ''}}" currentImageId="{{$product->image2}}"/>
            <x-select-image :images="$images" name="image3" currentImage="{{$product->imageThird->filename ?? ''}}" currentImageId="{{$product->image3}}"/>
            <x-select-image :images="$images" name="image4" currentImage="{{$product->imageFourth->filename ?? ''}}" currentImageId="{{$product->image4}}"/>
              
          <input id="" type="hidden" name="shop_id" value="{{ $shop->id }}">
        
          <div class="p-2 w-full">
            <button type="submit" class="flex mx-auto text-white bg-indigo-500 border-0 mt-12 py-2 px-20 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新</button>
          </div>
        </form>
      
        <form  action="{{ route('owner.products.destroy', ['product' => $product['id']]) }}" method="POST">
          @csrf
          @method('delete')
          <button type="submit" class="flex mx-auto text-white bg-red-500 border-0 mt-12 py-2 px-20 focus:outline-none hover:bg-red-600 rounded text-lg">削除</button>
        </form>

      </div>
    </div>
  </section>

  <script>
    const images = document.querySelectorAll('.image');

    images.forEach(image => {
      image.addEventListener('click', function(e) { 
      const imageName = e.target.dataset.id.substr(0, 6);
      //imageNameの箇所を空に置き換え↓
      const imageId = e.target.dataset.id.replace(imageName + '_', ''); 
      const imageFile = e.target.dataset.file;
      const imagePath = e.target.dataset.path;
      const modal = e.target.dataset.modal;

      document.getElementById(imageName + '_thumbnail').src = imagePath + '/' + imageFile; 
      document.getElementById(imageName + '_hidden').value = imageId;
      });
    });

    //選択解除処理
    const resetBtns = document.querySelectorAll('#resetBtn');
    resetBtns.forEach(resetBtn => {
    resetBtn.addEventListener('click', function(e) {
    const imageName = e.currentTarget.dataset.name; 
    console.log(imageName);
      document.getElementById(imageName + '_thumbnail').src = '';
      document.getElementById(imageName + '_hidden').value = '';
      MicroModal.close(modal); 
    })
    })
  </script>
  
</x-app-layout>
