<?php

namespace App\Models\Logistic2017;

use Illuminate\Database\Eloquent\Model;

class RO_HEADER extends Model
{
    //
    protected $connection='sqlsrv2';
    protected $table = 'RO_HEADER';  
    public $timestamps = false;
    protected $primaryKey = 'RONumber';
    protected $keyType = 'string';
    protected $fillable = ['GCRecord'];
}
