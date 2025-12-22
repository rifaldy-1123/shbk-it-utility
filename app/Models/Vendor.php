<?php

namespace App\Models;

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
