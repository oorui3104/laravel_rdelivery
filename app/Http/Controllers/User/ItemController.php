<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function index()
    {
        $stocks = DB::table('stocks')
            ->select('product_id', DB::raw('sum(quantity) as quantity'))
            ->groupBy('product_id')
            ->having('quantity', '>=', 1);;
        
        $products = DB::table('products')
            ->joinSub($stocks, 'stock', function ($join) {
            $join->on('products.id', '=', 'stock.product_id');
            })
            ->leftJoin('images', 'products.image1', '=', 'images.id')
            ->join('shops', 'products.shop_id', '=', 'shops.id')
            ->select('products.id as productId', 'products.name as productName', 'products.price', 'images.filename', 'shops.id as shopId', 'shops.name as shopName')
            ->paginate(8);
        
        return view('user.index', compact('products'));
    }

    public function shopShow($id) {
        $shop = Shop::findOrFail($id);
        return view('user.shop', compact('shop'));
    }

    public function show($id) {
        $product = Product::findOrFail($id);
        $quantity = Stock::where('product_id', $product->id)
        ->sum('quantity');
        return view('user.show', compact('product', 'quantity'));
    }


}
