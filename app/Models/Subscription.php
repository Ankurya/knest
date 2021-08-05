<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id', 
        'subscription_type',
        'subscription_start_date',
        'transaction_id',
        
    ];


    public function user(){
		return $this->belongsTo(User::class);
	}
	
}
