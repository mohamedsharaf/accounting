<?php

namespace App;
class Category extends Model
{

    public $with = ['items'];
    protected $guarded =[];

    protected $casts = [
        'id' => 'uuid',
        'company_id'=>'uuid',
        'branch_id'=>'uuid',
        'currency_id'=>'uuid',
        'category_id'=>'uuid',
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
