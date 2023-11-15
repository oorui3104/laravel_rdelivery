<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Owner;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UploadImageRequest;
use App\Service\StoreImage;

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

    public function update (UploadImageRequest $request, $id) {
        $imageFile = $request->image;

        //　画像のリサイズと保存（処理切り離し＆リサイズはライブラリ使用）
        if(!is_null($imageFile)) {
            $StorefileName = StoreImage::upload($imageFile, 'shops');
        }

        $request->validate([
            'name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'inquiry' => ['required'],
            'information' => ['max:300'],
        ]);

        $shop = Shop::findOrFail($id);
        $shop->name = $request->name;
        $shop->address = $request->address;
        $shop->inquiry = $request->inquiry;
        $shop->information = $request->information;
        
        if(!is_null($imageFile)) {
            $shop->filename = $StorefileName;
        }

        $shop->save();

        return to_route('owner.shops.index')
        ->with([
            'message' => '店舗情報を更新しました。',
            'status' => 'info'
        ]);
        
    }
}
