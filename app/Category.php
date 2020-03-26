<?php

namespace App;
class Category extends Model
{

    public $with = ['products'];
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

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }


}
