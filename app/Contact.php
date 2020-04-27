<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
//
class Contact extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'company_id' => 'uuid',
    ];

    public function uuidColumns(): array
    {
        return [
            'company_id'
        ];
    }


    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
