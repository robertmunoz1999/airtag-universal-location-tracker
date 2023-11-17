<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airtag extends Model
{
    protected $fillable = [
        'identifier',
        'name',
        'located_at',
        'latitude',
        'longitude',
    ];
}
