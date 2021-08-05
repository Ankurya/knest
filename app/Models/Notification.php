<?php

namespace App\Models;
use App\Models\Favourite;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
  protected $fillable = [
        'user_id', 
        'other_user_id',
        'message',
        'property_id',
        'notify_message',
        'type'
       
    ];
    public function Users(){
        return $this->belongsTo("App\Models\User",'other_user_id');
    }

}