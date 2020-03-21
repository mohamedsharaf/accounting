<?php

namespace App;

class Receipt extends Model
{
    protected $guarded = [];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'receipt_item');
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }
}
