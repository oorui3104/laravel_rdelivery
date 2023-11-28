<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index() {
        $user = User::findOrFail(Auth::id());
        $products = $user->products;

        //カート内の商品の合計金額の算出
        $totalPrice = 0;
        foreach($products as $product) {
            $totalPrice += $product->price * $product->pivot->quantity;
        }

        return view('user.cart', compact('products', 'totalPrice'));
    }


    public function store(Request $request, $id) {
        $ItemInCart = Cart::where('user_id', Auth::id())
        ->where('product_id', $id)
        ->first();

        //同一商品・ユーザーだった場合には数を追加
        if ($ItemInCart) {
            $ItemInCart->quantity += $request->quantity;
            $ItemInCart->save();
        } else {
            Cart::create([
                'product_id' => $id,
                'user_id' => Auth::id(),
                'quantity' => $request->quantity,
            ]);
        }

        return to_route('user.carts.index')
        ->with([
            'message' => '商品を追加しました。',
            'status' => 'info'
        ]);
    }


    public function delete($id) {
        Cart::where('user_id', Auth::id())
        ->where('product_id', $id)
        ->delete();

        return to_route('user.carts.index')
        ->with([
            'message' => '商品を削除しました。',
            'status' => 'error'
        ]);
    }


    public function checkout() {
        $user = User::findOrFail(Auth::id());
        $products = $user->products;
        $line_items = [];
        $totalPrice = 0;

        foreach($products as $product) {
            $quantity = Stock::where('product_id', $product->id)
            ->sum('quantity');

            //カートの数が在庫から多い場合には、カートに戻す
            if ($product->pivot->quantity > $quantity) {
                return to_route('user.carts.index')
                ->with([
                    'message' => $product->name .'は在庫切れです',
                    'status' => 'error'
                    ]);
            } else {
                $product_data = [
                    'name' => $product->name,
                    'description' => $product->information
                ];
                
                $price_data = [
                    'product_data' => $product_data,
                    'currency' => 'JPY',
                    'unit_amount' => $product->price
                ];
    
                $line_item = [
                    'price_data' => $price_data,
                    'quantity' => $product->pivot->quantity
                ];

                array_push($line_items, $line_item);
            }
        }

        //各商品のカートの数量分、在庫を減らす
        foreach ($products as $product) {
            Stock::create([
                'product_id' => $product->id,
                'type' => \Constants::PRODUCT_LIST['reduce'],
                'quantity' => $product->pivot->quantity * -1,
            ]);
        }

        //カート内の商品の合計金額の算出
        foreach($products as $product) {
            $totalPrice += $product->price * $product->pivot->quantity;
        }

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $session = \Stripe\Checkout\Session::create([
            'line_items' => [$line_items],
            'mode' => 'payment',
            'success_url' => route('user.carts.success'),
            'cancel_url' => route('user.carts.cancel'),
        ]);

        $publicKey = env('STRIPE_PUBLIC_KEY');

        return view('user.checkout', compact('session', 'publicKey', 'products', 'user', 'totalPrice'));
    }

    public function success() {
        Cart::where('user_id', Auth::id())
        ->delete();

        return to_route('user.carts.index')
        ->with([
            'message' => 'ご注文ありがとうございました！!',
            'status' => 'info'
        ]);
    }

    public function cancel() {
        $user = User::findOrFail(Auth::id());
        $products = $user->products;

        foreach ($products as $product) {
            Stock::create([
                'product_id' => $product->id,
                'type' => \Constants::PRODUCT_LIST['add'],
                'quantity' => $product->pivot->quantity,
            ]);
        }

        return to_route('user.carts.index');
    }
}
