<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Detail extends Model
{
    protected $table = 'order_details';
    protected $fillable = ['order_id', 'product_id', 'unitprice',
        'quantity', 'amount', 'discount'];

    public function product()
    {
        return $this->belongsTo('App\Product');

    }

    public function order()
    {
        return $this->belongsTo('App\Order');

    }

}
