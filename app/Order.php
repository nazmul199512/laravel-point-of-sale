<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['name', 'phone'];

    public function orderdetail()
    {
        return $this->hasMany('App/Order_Detail');
    }

}
