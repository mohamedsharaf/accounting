<?php

namespace App;

use Illuminate\Database\Eloquent\Model as ElequentModel;
use Dyrynda\Database\Support\GeneratesUuid;
use Spatie\Translatable\HasTranslations;

use Illuminate\Database\Eloquent\SoftDeletes;

class Model extends ElequentModel
{
    //
    use SoftDeletes;
    public $incrementing = false;
    protected $primaryKey = 'id'; // or null

//    use GeneratesUuid;

//    public function uuidColumn(): string
//    {
//        return 'id';
//    }
//    protected $uuidVersion = 'ordered';
//    protected $casts = [
//        'id' => 'uuid'
//    ];

    use HasTranslations;
//    public $translatable = ['name'];


    protected $appends = ['_f_translate'];
    protected $hidden = ['deleted_at'];


    public function __construct(array $attributes = [])
    {
        $attributes['id'] = \Str::orderedUuid();
        parent::__construct($attributes);
    }


    function getFTranslateAttribute() {
        return $this->translatable ;
    }




//    public function getRouteKeyName()
//    {
//        return 'id';
//    }
}
