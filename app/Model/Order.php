<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Destination;

class Order extends Model
{
    //

    public function destination()
    {
        return Destination::find($this->destination_id);
    }
}
