<?php

namespace App;

class Item extends Model
{

    protected $guarded = [];

    protected $casts = [
        'id' => 'uuid',
        'company_id' => 'uuid',
        'branch_id' => 'uuid',
        'currency_id' => 'uuid',
    ];

    public function uuidColumns(): array
    {
        return ['id'];
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_item');
    }


    public function receipt()
    {
        return $this->belongsToMany(Receipt::class, 'receipt_item');
    }


}
