<?php

namespace App\Models\Santosacare;

use Illuminate\Database\Eloquent\Model;

class ACT extends Model
{
    //
    protected $connection='sqlsrv1';
    protected $table = 'ACT';   
    public $timestamps = false;
    
    //protected $primaryKey = 'NoSEP';
}
