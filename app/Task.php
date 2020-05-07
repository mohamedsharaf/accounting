<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = ['id'];
    protected $with=['employees'];

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }
}
