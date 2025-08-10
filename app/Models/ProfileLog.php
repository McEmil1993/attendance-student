<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ProfileLog extends Model
{
     use HasFactory;

    protected $fillable = [
        'id_number',
        'fullname',
        'ip_address',
        'device_type',
        'lat_long',
        'status',
        'attempt_count',
        'user_agent'
    ];
}
