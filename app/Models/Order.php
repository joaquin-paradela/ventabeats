<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderItems;
use App\Models\Status;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = ['total_price', 'session_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    De esta manera, puedes acceder a los productos de un pedido y
     a los detalles de un pedido desde el modelo Order o el modelo OrderItem. 
     Por ejemplo, si quieres obtener los productos de un pedido, puedes hacer lo siguiente:

     $order = Order::find(1);
    $products = $order->orderItems->map(function ($item) {
        return $item->product;
    });
    */

    //arreglar...
    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }
}
