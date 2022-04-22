<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Order;

class Destination extends Model
{

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
