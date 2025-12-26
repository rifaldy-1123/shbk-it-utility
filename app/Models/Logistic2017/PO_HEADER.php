<?php

namespace App\Models\Logistic2017;

use Illuminate\Database\Eloquent\Model;

class PO_HEADER extends Model
{
    //
    protected $connection='sqlsrv2';
    protected $table = 'PO_HEADER';  
    public $timestamps = false;
    protected $primaryKey = 'PONumber';
    protected $keyType = 'string';
    protected $fillable = ['OrderStatusID'];
}
