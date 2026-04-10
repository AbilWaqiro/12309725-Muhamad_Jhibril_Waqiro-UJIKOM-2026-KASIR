<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'phone_number',
        'total_poin',
    ];

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
