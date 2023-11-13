<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'name',
        'address',
        'inquiry',
        'information',
        'filename',
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
}