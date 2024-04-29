<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dataup extends Model
{
    use HasFactory;
    protected $table = 'up';
    protected $primaryKey = 'id';
    protected $fillable = [
        'down_id',
        'ip_address',
        'unit_name',
        'up_time',
    ];

    public function down()
    {
        return $this->belongsTo(Down::class); // Perbaikan referensi kelas menjadi data_down::class
    }

}
