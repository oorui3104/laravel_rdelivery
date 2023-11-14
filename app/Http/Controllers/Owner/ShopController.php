<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Owner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use InterventionImage;

class ShopController extends Controller
{

    public function __construct()
    {
        // ログインしているオーナーに紐づくショップ情報のみアクセス可
        $this->middleware(function ($request, $next) {
            $id = $request->route()->parameter('id');
            if (!is_null($id)) {
                $shopId = Shop::findOrFail($id)->owner->id;
                $shopOwnerId = (int)$shopId;
                $ownerId = Auth::id();
                if ($shopOwnerId !== $ownerId) {
                    abort(404);
                } 
            }

            return $next($request);
        });
    }

    public function index () {
       $shop = Owner::findOrFail(Auth::id())->shop()->first();
       return view('owner.shops.index', compact('shop'));
    }
    
    public function edit ($id) {
        $shop = Shop::findOrFail($id);
        return view('owner.shops.edit', compact('shop'));
    }

    public function update (Request $request, $id) {
        $imageFile = $request->image;

        //　画像のリサイズと保存（ライブラリ使用）
        if(!is_null($imageFile)) {
            $resizedImage = InterventionImage::make($imageFile)
            ->resize(1920, 1080)
            ->encode();

            $fileName = uniqid();
            $extension = $imageFile->extension();
            $StorefileName = $fileName . '.' . $extension;

            Storage::put('public/shops/' . $StorefileName, $resizedImage);
        }
        
    }
}
