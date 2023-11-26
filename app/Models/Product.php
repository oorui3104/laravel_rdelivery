<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $fillable = [
        'shop_id',
        'name',
        'price',
        'information',
        'image1',
        'image2',
        'image3',
        'image4',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function ImageFirst()
    {
        return $this->belongsTo(Image::class, 'image1', 'id');
    }

    public function ImageSecound()
    {
        return $this->belongsTo(Image::class, 'image2', 'id');
    }

    public function ImageThird()
    {
        return $this->belongsTo(Image::class, 'image3', 'id');
    }

    public function ImageFourth()
    {
        return $this->belongsTo(Image::class, 'image4', 'id');
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'carts')
        ->withPivot('id', 'quantity');
    }

}
