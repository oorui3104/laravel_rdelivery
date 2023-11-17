@php
  if( $name === 'image1') { $modal = 'modal-1';}
  if( $name === 'image2') { $modal = 'modal-2';}
  if( $name === 'image3') { $modal = 'modal-3';}
  if( $name === 'image4') { $modal = 'modal-4';}
@endphp

<div class="modal micromodal-slide" id="{{ $modal }}" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
      <header class="modal__header">
        <h2 class="text-xl modal__title" id=""{{ $modal }}"-title">
          ファイルを選択してください（商品画像管理でアップロードした画像が選択できます。）
        </h2>
        <button type="button" class="modal__close" aria-label="Close modal" data-micromodal-close></button>
      </header>
      <main class="modal__content" id=""{{ $modal }}"-content">
        <div class="flex flex-wrap -m-4">
          @foreach ($images as $image)
            <div class="lg:w-1/4 md:w-1/2 p-4 mb-20 w-full">
              <img alt="" class="image object-contain object-center w-full h-full block" 
              data-id="{{ $name }}_{{ $image->id }}"
              data-file="{{ $image->filename }}"
              data-path="{{ asset('/storage/products/') }}"
              data-modal="{{ $modal }}"
              data-micromodal-close
              src="{{ asset('/storage/products/' . $image["filename"]) }}">
            </div>  
          @endforeach
        </div>
      </main>
      <footer class="modal__footer">
        <button type="button" class="modal__btn" data-micromodal-close aria-label="Close this dialog window">閉じる</button>
        <button type="button" id="resetBtn" class="modal__btn" 
        data-name="{{ $name }}"
        data-micromodal-close aria-label="Close this dialog window">選択解除</button>
      </footer>
    </div>
  </div>
</div>

<div class="flex justify-between items-center mb-4 mt-4"> 
  <a href="#" class="text-blue-500" data-micromodal-trigger="{{ $modal }}">ファイルを選択</a>
  <div class="w-1/4">
    <img id="{{ $name }}_thumbnail" src=""> 
  </div>
</div>

<input id="{{ $name }}_hidden" type="hidden" name="{{ $name }}"" value="">