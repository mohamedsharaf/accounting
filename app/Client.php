<?php

namespace App;

class Client extends Model
{
    protected $guarded = [];
    public function receipt()
    {
        return $this->hasMany(Receipt::class);
    }
}
