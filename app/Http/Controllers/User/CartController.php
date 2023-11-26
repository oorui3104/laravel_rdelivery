<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index() {

        $user = User::findOrFail(Auth::id());
        $products = $user->products;

        //カートない商品の合計金額の算出
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
}
