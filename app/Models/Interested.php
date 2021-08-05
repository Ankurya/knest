<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interested extends Model
{
     protected $fillable = [
        'user_id', 
        'property_id',
        'going',
        'type',
        
    ];
}