<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Journal extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $fillable = ['id', 'user_id','company_id', 'branch_id', 'amount', 'paid_at', 'description', 'reference'];

    // public function ledgers()
    // {
    //     return $this->hasMany(Ledger::class);
    // }

    public function ledgers()
    {
        return $this->morphMany(Ledger::class, 'ledgerable');
    }


    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
