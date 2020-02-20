<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

    public $translatable = ['name'];

    protected $casts = [
        'id' => 'uuid',
        'company_id' => 'uuid',
    ];

    protected $fillable = [
        'id',
        'company_id',
        'name',
    ];


    public function uuidColumns(): array
    {
        return [
            'id',
            'company_id'
        ];
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
