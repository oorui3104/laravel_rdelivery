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

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
            'information' => ['nullable', 'string', 'max:300'],
            'shop_id' => ['required', 'exists:shops,id'],
            'image1' => ['nullable', 'exists:images,id'],
            'image2' => ['nullable', 'exists:images,id'],
            'image3' => ['nullable', 'exists:images,id'],
            'image4' => ['nullable', 'exists:images,id'],
        ]);

        try {
            DB::transaction(function () use($request){
                $product = Product::create([
                    'name' => $request->name,
                    'price' => $request->price,
                    'information' => $request->infromation,
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
