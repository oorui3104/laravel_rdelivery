

<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          ご注文確認
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                <div>
                  <h1 class="w-full mb-8 text-xl px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-white">ご注文商品</h1>
                  @foreach ($products as $product)
                  <div class="flex md:justify-start md:items-center mb-4">
                    <div class="w-4/12 ">{{ $product['name'] }}</div>
                    <div class="w-1/12 ml-4">{{ $product->pivot->quantity }}個</div>
                    <div class="md:w-2/12 ml-4">{{ number_format($product['price'] * $product->pivot->quantity ) }}円（税込）</div>
                  </div>
                  @endforeach
                  <div class="text-end text-xl">小計：{{number_format($totalPrice)}}円（税込）</div>
                </div>

                <div class="mt-16">
                  <h1 class="mb-8 text-xl px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-white"">お届け先</h1>
                  <div class="w-4/12 ">〒 {{ $user['postcode'] }}</div>
                  <div class="w-10/12">{{ $user['address'] }}</div>
                </div>
                  
                <div class="flex justify-end gap-8">
                  <button type="button" class="text-white bg-red-500 border-0 py-2 px-6 mt-8 focus:outline-none hover:bg-red-600 rounded"><a href="{{ route('user.carts.cancel')}}">カートに戻る</a></button>
                  <button type="button" id="checkout-button" class="text-white bg-indigo-500 border-0 py-2 px-6 mt-8 focus:outline-none hover:bg-indigo-600 rounded">決済画面に進む</button>
                </div>
            </div>
          </div>
      </div>
  </div>
</x-app-layout>

<script src="https://js.stripe.com/v3/"></script>

<script>
  const publicKey = '{{ $publicKey }}' 
  const stripe = Stripe(publicKey)
  const button = document.querySelector('#checkout-button');

  button.addEventListener('click', function() {
    stripe.redirectToCheckout({
    sessionId: '{{ $session->id }}'
    })
  })
</script>