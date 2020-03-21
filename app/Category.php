<?php

namespace App;
class Category extends Model
{

    protected $casts = [
        'id' => 'uuid',
        'company_id'=>'uuid',
        'branch_id'=>'uuid',
        'currency_id'=>'uuid',
        'parent_id'=>'uuid',
    ];

    public function uuidColumns(): array
    {
        return [ 'id' ];
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'category_item');
    }
}
