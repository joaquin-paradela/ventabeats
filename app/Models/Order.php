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

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }
}
