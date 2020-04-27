<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = ['id'];

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
        return $this->belongsToMany('App\Employee', 'employee_project');
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function projects()
    {
        return $this->belongsToMany('App\Letter', 'project_letter', 'project_id', 'letter_id');
    }

}
