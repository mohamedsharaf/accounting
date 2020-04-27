<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['user_id', 'title', 'street', 'city', 'state', 'zip_code', 'country', 'default'];

    protected $casts = [
        'id' => 'uuid',
    ];
    public function uuidColumns(): array
    {
        return [
            'id'
        ];
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
