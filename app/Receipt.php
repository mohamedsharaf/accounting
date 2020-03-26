<?php

namespace App;

class Receipt extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'receipt_product');
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }
}
