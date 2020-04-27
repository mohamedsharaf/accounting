<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $guarded=['id'];

    protected $casts = [
        'id' => 'uuid',
        'currency_id' => 'uuid',
    ];

    public function uuidColumns(): array
    {
        return [
            'id',
            'currency_id'
        ];
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function letters()
    {
        return $this->belongsToMany('App\Letter', 'section_letter', 'section_id', 'letter_id');
    }
}
