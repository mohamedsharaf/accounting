<?php

namespace App;

class Client extends Model
{
    public function receipt()
    {
        return $this->hasMany(Receipt::class);
    }
}
