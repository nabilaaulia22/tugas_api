<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dataunit extends Model
{
    use HasFactory;

    protected $table ="dataunit";
    protected $primary_key="id";
    protected $fillable=[
        'id_unit',
        'ip_unit',
        'unit_name'
    ];

}
