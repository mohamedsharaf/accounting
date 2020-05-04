<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    protected $with = ['contact'];
    protected $fillable = ['type','subject','content', 'contact_id', 'user_id'];

    // protected $casts = [
    //     'section_id' => 'uuid',
    //     'id' => 'uuid'
    // ];

    // public function uuidColumns(): array
    // {
    //     return [
    //         'section_id',
    //         'id'
    //     ];
    // }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function projects()
    {
        return $this->belongsToMany('App\Project', 'project_letter', 'letter_id', 'project_id');
    }

    public function sections()
    {
        return $this->belongsToMany('App\Section', 'section_letter', 'letter_id', 'section_id');
    }

    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }
}
