<?php

namespace App\Models;

use App\Models\Coin;
use App\Models\OrderItems;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'products';

    protected $fillable = ['name', 'description', 'price'];
    
    protected $dates = ['deleted_at'];

    public function coin()
    {
        return $this->belongsTo(Coin::class, 'id_coin');
    }

     //arreglar... un producto solo puede estar en una orderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }

    /*
    Para "eliminar" un registro, usa el método delete() del modelo:

    $producto = Producto::find(1);
    $producto->delete();
    Este método establece la fecha actual en la columna 'deleted_at', lo que indica que el registro está "eliminado".

    Para restaurar un registro eliminado, usa el método restore():

    $producto = Producto::withTrashed()->find(1);
    $producto->restore();
    Este método elimina la fecha de la columna 'deleted_at', lo que indica que el registro ya no está "eliminado".

    Para eliminar permanentemente un registro "eliminado", usa el método forceDelete():

    $producto = Producto::withTrashed()->find(1);
    $producto->forceDelete();
        
    */

    /*$product = Product::find(1);

    // Obtener todos los items de orden para este producto
    $orderItems = $product->orderItems;
 */


   
}
