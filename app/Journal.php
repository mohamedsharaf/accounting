<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $fillable = ['id','company_id', 'branch_id', 'amount', 'paid_at', 'description', 'reference'];

    // public function ledgers()
    // {
    //     return $this->hasMany(Ledger::class);
    // }

    public function ledgers()
    {
        return $this->morphMany(Ledger::class, 'ledgerable');
    }

}
