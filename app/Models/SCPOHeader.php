<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SCPOHeader extends Model
{
    //
    protected $connection='sqlsrv1';
    protected $table = 'PODetail';  
    public $timestamps = false;
    protected $primaryKey = 'IDPOHeader';
    //protected $keyType = 'string';
    protected $fillable = ['OrderStatusID'];
}
