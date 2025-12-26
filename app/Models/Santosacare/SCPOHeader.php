<?php

namespace App\Models\Santosacare;

use Illuminate\Database\Eloquent\Model;

class SCPOHeader extends Model
{
    //
    protected $connection='sqlsrv1';
    protected $table = 'POHeader';  
    public $timestamps = false;
    protected $primaryKey = 'IDPOHeader';
    //protected $keyType = 'string';
    protected $fillable = ['OrderStatusID'];
}
