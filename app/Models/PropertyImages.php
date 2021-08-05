<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyImages extends Model
{
    protected $fillable = [
        'user_id', 
        'property_id',
        'profile',
        'type',
        
    ];

  public function getProfileAttribute($value){
        $base_path = public_path("storage/property_images");
        $profile = $value;

        if(!empty($profile) && file_exists($base_path.'/'.$profile)){
            return url("public/storage/property_images").'/'.$profile;
        }
        return "";
    }


}
