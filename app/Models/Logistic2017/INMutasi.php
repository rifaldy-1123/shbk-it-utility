<?php

namespace App\Models\Logistic2017;

use Illuminate\Database\Eloquent\Model;

class INMutasi extends Model
{
    protected $connection='sqlsrv2';
    protected $table = 'INMutasi';  
    public $timestamps = false;
    protected $primaryKey = 'NoInvoice';
    protected $keyType = 'string';
    protected $fillable = ['GCRecord'];
}
