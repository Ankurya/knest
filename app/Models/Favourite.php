<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Favourite extends Model
{
 	protected $fillable = [
        'user_id', 
        'property_id',
        'is_favourite',
        'type'
        
    ];

	public function user(){
		return $this->belongsTo(User::class);
	}
   
}
