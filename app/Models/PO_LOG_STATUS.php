<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PO_LOG_STATUS extends Model
{
    //
    protected $connection='sqlsrv2';
    protected $table = 'PO_LOG_STATUS';  
    public $timestamps = false;
    //protected $primaryKey = 'RONumber';
    //protected $keyType = 'string';
    protected $fillable = ['GCRecord'];
}
