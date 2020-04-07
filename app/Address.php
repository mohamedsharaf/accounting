<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['user_id', 'title', 'street', 'city', 'state', 'zip_code', 'country', 'default'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
