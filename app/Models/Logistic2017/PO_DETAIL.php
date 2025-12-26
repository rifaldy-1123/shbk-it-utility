<?php

namespace App\Models\Logistic2017;

use Illuminate\Database\Eloquent\Model;

class PO_DETAIL extends Model
{
    //
    protected $connection='sqlsrv2';
    protected $table = 'PO_DETAIL';  
    public $timestamps = false;
    protected $primaryKey = 'IDPODetail';
    protected $keyType = 'string';
    protected $fillable = ['OrderStatusID'];
}
