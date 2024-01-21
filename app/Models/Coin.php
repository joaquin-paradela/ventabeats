<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;


class Coin extends Model
{
    use HasFactory;

    protected $table = 'coins';

    protected $fillable = ['description'];

    public function products()
    {
        return $this->hasMany(Product::class, 'id_product');
    }


}
