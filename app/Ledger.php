<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{

    protected $fillable = [
        'id', 'company_id', 'account_id', 'journal_id', 'branch_id',
        'ledgerable_type', 'ledgerable_id', 'issued_at',
        'entry_type', 'debit', 'credit', 'amount', 'amount_foreign', 'foreign_rate', 'reference'];


    public static function boot(){
        parent::boot();
        self::saving(function($model){
            if($model->amount > 0){
                $model->credit = $model->amount ;
            }
            if($model->amount < 0){
                $model->debit = $model->amount  * -1;
            }

            if(!isset($model->foreign_rate)){
                //TODO work on handling exchange rate options
                $model->foreign_rate = 1;
            }
            if(!isset($model->amount_foreign)){
                //TODO work on handling exchange rate options
                $model->amount_foreign = $model->amount;
            }


        });
    }

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

    // public function journal()
    // {
    //     return $this->belongsTo(Journal::class);
    // }
}
