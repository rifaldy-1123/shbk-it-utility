<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class INLogger extends Model
{
    //
    protected $connection='sqlsrv2';
    protected $table = 'INLogger';  
    public $timestamps = false;
    protected $primaryKey = 'NoDokumen';
    protected $keyType = 'string';
    protected $fillable = ['GCRecord'];
}
