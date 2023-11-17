<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
