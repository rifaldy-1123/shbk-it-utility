<?php

namespace App\Models\Santosacare;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    //
    protected $connection='sqlsrv1';
     protected $table = 'person';   // nama tabel
    public $timestamps = false;
    // yang 
    protected $primaryKey = 'RecordKey';
}
