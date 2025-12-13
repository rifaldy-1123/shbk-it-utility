<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class INMutasiD extends Model
{
    protected $connection='sqlsrv2';
    protected $table = 'INMutasiD';  
    public $timestamps = false;
    protected $primaryKey = 'NoInvoice';
    protected $keyType = 'string';
    protected $fillable = ['GCRecord'];
}
