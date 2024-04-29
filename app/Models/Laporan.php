<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;
    protected $table = 'laporan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ip_address',
        'unit_name',
        'down_time',
        'up_time',
        'duration',
    ];
    public $timestamps = false;

}
