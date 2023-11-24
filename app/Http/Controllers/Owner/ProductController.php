<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\Shop;
use App\Models\Stock;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
   
    public function __construct()
    {
        // ログインしているオーナーに紐づく画像情報のみ削除可
        $this->middleware(function ($request, $next) {
            $id = $request->route()->parameter('product');
            if (!is_null($id)) {
                $getOwnerId = Product::findOrFail($id)->shop->owner->id;
                $productOwnerId = (int)$getOwnerId;
                $ownerId = Auth::id();
                if ($productOwnerId !== $ownerId) {
                    abort(404);
                } 
            }

            return $next($request);
        });
    }

    public function index()
    {
        //viewでproductをループさせる
        $ownerInfo = Owner::with('shop.product.ImageFirst')
        ->where('id', Auth::id())
        ->first();

        return view('owner.products.index', compact('ownerInfo'));
    }

    public function create()
    {
        $shop = Shop::where('owner_id', Auth::id())
        ->select('id', 'name')
        ->first();

        $images = Image::where('owner_id', Auth::id())
        ->select('id', 'filename')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('owner.products.create', compact('shop', 'images'));
    }

    public function store(ProductRequest $request)
    {
        try {
            DB::transaction(function () use($request){
                $product = Product::create([
                    'name' => $request->name,
                    'price' => $request->price,
                    'information' => $request->information,
                    'shop_id' => $request->shop_id,
                    'image1' => $request->image1,
                    'image2' => $request->image2,
                    'image3' => $request->image3,
                    'image4' => $request->image4,
                ]);

                Stock::create([
                    'product_id' => $product->id,
                    'type' => 1,
                    'quantity' => $request->quantity,
                ]);
            });
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return to_route('owner.products.index')
        ->with([
            'message' => '商品を登録しました。',
            'status' => 'info'
        ]);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        
        $shop = Shop::where('owner_id', Auth::id())
        ->select('id', 'name')
        ->first();

        $images = Image::where('owner_id', Auth::id())
        ->select('id', 'filename')
        ->orderBy('created_at', 'desc')
        ->get();

        $stock = Stock::where('product_id', $product->id)
        ->sum('quantity');

        return view('owner.products.edit', compact('product', 'shop', 'images', 'stock'));
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        try {
            DB::transaction(function () use($request, $product) {
                //対象の商品情報を更新
                $product->name = $request->name;
                $product->price = $request->price;
                $product->information = $request->information;
                $product->shop_id = $request->shop_id;
                $product->image1 = $request->image1;
                $product->image2 = $request->image2;
                $product->image3 = $request->image3;
                $product->image4 = $request->image4;
                $product->save();
                
                //在庫情報を更新
                if (!is_null($request->type)) {
                    if ($request->type === \Constants::PRODUCT_LIST['add']) 
                        { $quantity = $request->quantity; }
                    if ($request->type === \Constants::PRODUCT_LIST['reduce']) 
                        { $quantity = $request->quantity * -1; }
                    Stock::create([
                        'product_id' => $product->id,
                        'type' => $request->type,
                        'quantity' => $quantity,
                    ]);
                }
            });
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return to_route('owner.products.index')
        ->with([
            'message' => '商品情報を更新しました。',
            'status' => 'info'
        ]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return to_route('owner.products.index')
        ->with([
            'message' => '商品を削除しました。',
            'status' => 'error'
        ]);
    }
}
