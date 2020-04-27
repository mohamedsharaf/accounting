<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'employee_id' => 'uuid',
    ];

    public function uuidColumns(): array
    {
        return [
            'employee_id'
        ];
    }


    public function holidayType()
    {
        return $this->belongsTo('App\HolidayType');
    }

    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }
}
