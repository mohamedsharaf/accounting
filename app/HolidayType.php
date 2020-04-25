<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HolidayType extends Model
{
    use HasTranslations;

    protected $guarded= ['id'];
    public $translatable = ['name'];
    
    public function holidays()
    {
        return $this->hasMany('App\Holiday');
    }
    
}
