<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }
}
