<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{



    public function ledgerable()
    {
        return $this->morphTo();
    }

    public function Currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
