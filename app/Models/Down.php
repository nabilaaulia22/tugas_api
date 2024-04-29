<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Down extends Model
{
    use HasFactory;

    protected $table = 'down';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ip_address',
        'unit_name',
        'down_time',
    ];

    public function up()
    {
        return $this->hasOne(Dataup::class, 'down_id');
    }

    public function isUp()
    {
        return $this->up()->exists();
    }
}
