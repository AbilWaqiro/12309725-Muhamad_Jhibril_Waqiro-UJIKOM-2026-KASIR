<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetailOrder;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'stock',
        'image',
    ];

    public function detailOrder()
    {
        return $this->hasMany(DetailOrder::class);
    }
}
