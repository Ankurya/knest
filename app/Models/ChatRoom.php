<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{


protected $table = 'chat_rooms';


    protected $fillable = [
        'sender_user_id', 
        'receiver_user_id',
        'deleted_at',
        'message'
    ];


    // public function sender()
    // {
    //     return $this->belongsTo(User::class, 'sender_user_id')->select(['id', 'message']);
    // }

    // public function receiver()
    // {
    //     return $this->belongsTo(User::class, 'receiver_user_id')->select(['id', 'message']);
    // }


    public function sender() {
    return $this->belongsTo('App\Models\User', 'sender_user_id');
  }

    public function receiver() {
    return $this->belongsTo('App\Models\User', 'receiver_user_id');
   }


}
