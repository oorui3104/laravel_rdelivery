<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'filename',
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'image1');
    }
}
