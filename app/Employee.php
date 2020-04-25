<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    protected $casts = [
        'id' => 'uuid',
        'company_id' => 'uuid',
        'section_id' => 'uuid'
    ];

    public function uuidColumns(): array
    {
        return [
            'id',
            'company_id',
            'section_id'
        ];
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function projects()
    {
        return $this->belongsToMany('App\Project', 'employee_project');
    }

    public function sections()
    {
        return $this->belongsTo(Section::class);
    }

    public function holidays()
    {
        return $this->hasMany(Holiday::class, 'employee_id');
    }

}
