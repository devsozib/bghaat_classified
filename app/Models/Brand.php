<?php

namespace App\Models;

use App;
use App\Models\CustomerProduct;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

  protected $with = ['brand_translations'];

  public function getTranslation($field = '', $lang = false){
      $lang = $lang == false ? App::getLocale() : $lang;
      $brand_translation = $this->brand_translations->where('lang', $lang)->first();
      return $brand_translation != null ? $brand_translation->$field : $this->$field;
  }  

  public function customerProducts(){
    return $this->hasMany(CustomerProduct::class);
  }

  public function brand_translations(){
    return $this->hasMany(BrandTranslation::class);
  }

}
