<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Coin;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    public function coin()
    {
        return $this->belongsTo(Coin::class, 'id_coin');
    }
}
