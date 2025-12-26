<?php

namespace App\Models\Santosacare;

use Illuminate\Database\Eloquent\Model;

class OEFarmasi extends Model
{
    //
    protected $connection='sqlsrv1';
    protected $table = 'oefarmasi';   // nama tabel
    public $timestamps = false;
    // yang 
    protected $primaryKey = 'NoInvoice';
    protected $keyType = 'string';
    protected $fillable = ['NoTrxRefKunjungan','NoSEP'];
}
