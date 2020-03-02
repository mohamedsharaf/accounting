<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{

    public $translatable = ['name'];

    protected $casts = [
        'id' => 'uuid',
        'company_id' => 'uuid',
    ];
    public function uuidColumns(): array
    {
        return [
            'id',
            'company_id'
        ];
    }

    protected $fillable = [
        'id',
        'company_id',
        'name',
        'code',
        'rate',
        'symbol',
        'symbol_first',
        'decimal_mark',
        'thousands_separator',
        'enabled',
    ];

    public function Company()
    {
        return $this->belongsTo(Company::class);
    }
}
