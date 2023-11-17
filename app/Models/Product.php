<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function ImageFirst()
    {
        return $this->belongsTo(Image::class, 'image1', 'id');
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

}
