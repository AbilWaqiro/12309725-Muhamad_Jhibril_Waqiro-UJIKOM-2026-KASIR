<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Customer;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'customer_id',
        'sale_date',
        'total_price',
        'total_pay',
        'total_return',
        'points_earned',
        'points_used',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function detailOrder()
    {
        return $this->hasMany(DetailOrder::class);
    }
}
