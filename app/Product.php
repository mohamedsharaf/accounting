<?php

namespace App;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;
    
    protected $fillable = ['id','title','price','quantity', 'company_id', 'branch_id'];

    protected $casts = [
        'id' => 'uuid',
        'company_id' => 'uuid',
        'branch_id' => 'uuid',
        // 'currency_id' => 'uuid',
    ];

    public function uuidColumns(): array
    {
        return ['id'];
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }


    public function receipt()
    {
        return $this->belongsToMany(Receipt::class, 'receipt_product');
    }


}
