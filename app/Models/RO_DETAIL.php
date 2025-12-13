<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RO_DETAIL extends Model
{
    //
     protected $connection='sqlsrv2';
    protected $table = 'RO_DETAIL';  
    public $timestamps = false;
    protected $primaryKey = 'RONumber';
    protected $keyType = 'string';
    protected $fillable = ['GCRecord'];
}
