<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'id', 'company_id', 'section_id',
        'iqama_number',
        'name',
        'gender',
        'nationality',
        'occupation',
        'passport_number',
        'passport_expiry_date_hijri',
        'passport_expiry_date_gregorian',
        'iqama_expiry_date_hijri',
        'iqama_expiry_date_gregorian',
        'insurance_status',
        'insurance_expiry',
        'status',
        'trash'
    ];

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

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

}
