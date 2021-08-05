<?php

namespace App\Models;
use App\Models\PropertyImages;
use App\Models\Favourite;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
      protected $fillable = [
        'user_id', 
        'property_type',
        'property_price',
        'number_of_bedroom',
        'number_of_bathroom',
        'address',
        'tax',
        'plot_size',
        'building_size', 
        'school_district',
        'date',
        'start_time',
        'end_time',
        'description',
        'status',
        'latitude',
        'longitude',
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

    public function Images(){
        return $this->hasMany("App\Models\PropertyImages");
    }
    
    public function Users(){
        return $this->belongsTo("App\Models\User",'user_id');
    }

    public function favourites(){
        return $this->hasMany(Favourite::class)->whereIsFavourite(1)->with('user');
    }
   
    
    
}