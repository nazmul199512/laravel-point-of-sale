<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
      protected $table = 'transactions';
      protected $fillable = ['order_id', 'paid_amount',
          'balance', 'transac_date', 'transac_amount', 'user_id', 'payment_method'];
}
