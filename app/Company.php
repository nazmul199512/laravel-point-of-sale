<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';
    protected $fillable = ['company_name', 'company_email', 'company_phone',
        'company_address', 'company_fax'];
}

