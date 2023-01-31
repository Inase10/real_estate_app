<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'area','room_num','bath_num','locations_id','storey','price','price_rent_per_day' ,'type','cover_image','disc'
    ];
    public function getPropertiesID($city_name){
        $props= Location::where('city_name', $city_name)->get();

    }

}
