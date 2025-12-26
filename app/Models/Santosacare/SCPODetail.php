<?php

namespace App\Models\Santosacare;

use Illuminate\Database\Eloquent\Model;

class SCPODetail extends Model
{
    //
    protected $connection='sqlsrv1';
    protected $table = 'PODetail';  
    public $timestamps = false;
    protected $primaryKey = 'IDPODetail';
    //protected $keyType = 'string';
    protected $fillable = ['Qty_Cancelled','SubTotal_Cancelled','OrderStatusID'];
}
