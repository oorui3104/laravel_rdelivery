<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\UploadImageRequest;
use Illuminate\Http\RedirectResponse;
use App\Service\StoreImage;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function __construct()
    {
        // ログインしているオーナーに紐づく画像情報のみ削除可
        $this->middleware(function ($request, $next) {
            $id = $request->route()->parameter('id');
            if (!is_null($id)) {
                $getOwnerId = Image::findOrFail($id)->owner->id;
                $imageOwnerId = (int)$getOwnerId;
                $ownerId = Auth::id();
                if ($imageOwnerId !== $ownerId) {
                    abort(404);
                } 
            }

            return $next($request);
        });
    }

    public function index () {
        $images = Image::where('owner_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->paginate(8);

        return view('owner.images.index', compact('images'));
    }

    public function store(UploadImageRequest $request): RedirectResponse {
        $imageFiles = $request->file('files');

        //　画像のリサイズと保存（処理切り離し＆リサイズはライブラリ使用）
        if(!is_null($imageFiles)) {
            foreach ($imageFiles as $imageFile) {
                $StorefileName = StoreImage::upload($imageFile, 'products');
                Image::create([
                    'owner_id' => Auth::id(),
                    'filename' => $StorefileName,
                ]);
            }
        }

        return to_route('owner.images.index')
        ->with([
            'message' => '画像を登録しました。',
            'status' => 'info'
        ]);
    }

    public function destroy(Request $request, $id): RedirectResponse
    {

        $image = Image::findOrFail($id);

        $imageInProducts = Product::where('image1', $image->id)
        ->orWhere('image2', $image->id)
        ->orWhere('image3', $image->id)
        ->orWhere('image4', $image->id)
        ->get();

        if($imageInProducts){
            $imageInProducts->each(function($product) use($image){ 
                if($product->image1 === $image->id) {
                $product->image1 = null;
                $product->save(); 
                }
                if($product->image2 === $image->id) {
                $product->image2 = null;
                $product->save(); 
                }
                if($product->image3 === $image->id) {
                $product->image4 = null;
                $product->save(); 
                }
                if($product->image4 === $image->id) {
                $product->image4 = null;
                $product->save(); 
                }
            });
        }

        $filePath = '/public/products/' . $image->filename;
        Storage::delete($filePath);
        $image->delete();

        return to_route('owner.images.index')
        ->with([
            'message' => '画像を削除しました。',
            'status' => 'info'
        ]);
    }




}
