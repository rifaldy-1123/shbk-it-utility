<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElementDetail extends Model
{
    protected $connection='sqlsrv1';
    protected $table = 'elementdetail';  
    protected $primaryKey = 'ElementDetailKey';
    protected $fillable = ['GetDokter'];
}
