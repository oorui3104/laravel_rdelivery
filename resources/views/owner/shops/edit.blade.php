<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard') }}
      </h2>
  </x-slot>

  <section class="text-gray-600 body-font relative">
    <div class="container px-5 py-24 mx-auto">
      <div class="flex flex-col text-center w-full mb-12">
        <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900">店舗情報（更新）</h1>
        <p class="lg:w-2/3 mx-auto leading-relaxed text-base"></p>
      </div>
      <div class="lg:w-1/2 md:w-2/3 mx-auto">
        <form action="{{ route('owner.shops.update', ['id' => $shop['id']]) }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="p-2">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            <div class="relative">
              <label for="name" class="leading-7 text-sm text-gray-600">店舗名(必須)</label>
              <input type="text" id="name" name="name" value="{{ old('name', $shop['name']) }}"  class="w-full bg-white-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
          </div>
          <div class="p-2">
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
            <div class="relative">
              <label for="address" class="leading-7 text-sm text-gray-600">住所(必須)</label>
              <input type="text" id="address" name="address" value="{{ old('address', $shop['address']) }}" class="w-full bg-white-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
          </div>
          <div class="p-2">
            <div class="relative">
              <x-input-error :messages="$errors->get('inquiry')" class="mt-2" />
              <label for="inquiry" class="leading-7 text-sm text-gray-600">問い合わせ先(必須)</label>
              <input type="text" id="inquiry" name="inquiry" value="{{ old('inquiry', $shop['inquiry']) }}" class="w-full bg-white-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
          </div>
          <div class="p-2 w-full">
            <div class="relative">
              <x-input-error :messages="$errors->get('information')" class="mt-2" />
              <label for="information" class="leading-7 text-sm text-gray-600">店舗情報</label>
              <textarea id="information" name="information" class="w-full bg-white-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ old('information', $shop['information']) }}</textarea>
            </div>
          </div>
          <div class="p-2">
            <div class="relative bg-white-100">
              <x-input-error :messages="$errors->get('image')" class="mt-2" />
              <label for="image" class="leading-7 text-sm text-gray-600">店舗画像</label>
              <input type="file" id="image" name="image" accept="image/*" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 leading-8 transition-colors duration-200 ease-in-out">
            </div>
          </div>
          <div class="p-2 w-full">
            <button type="submit" class="flex mx-auto text-white bg-indigo-500 border-0 mt-12 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新</button>
          </div>
        </form>
      </div>
    </div>
  </section>
  
</x-app-layout>
