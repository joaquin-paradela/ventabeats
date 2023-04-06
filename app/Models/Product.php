<?php

namespace App\Models;

use App\Models\Coin;
use App\Models\OrderItems;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['name', 'description', 'price'];

    public function coin()
    {
        return $this->belongsTo(Coin::class, 'id_coin');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }
}
