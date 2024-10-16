<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // Define los campos que se pueden rellenar mediante la asignación masiva
    protected $fillable = [
        'email',
        'name',
        'address',
        'city',
        'region',
        'postal_code',
        'phone',
    ];
}
