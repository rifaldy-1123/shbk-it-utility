<?php

namespace App\Models\Logistic2017;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    //
    protected $connection='sqlsrv2';
    protected $table = 'VENDOR';  
    public $timestamps = false;
    protected $primaryKey = 'IDVendor';
    //protected $keyType = 'string';
}
