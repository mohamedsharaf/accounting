<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use AccountHelper;
use Str;
class Account extends Model
{
    public $translatable = ['name'];

    protected $casts = [
        'id' => 'uuid',
    ];

    public function uuidColumns(): array
    {
        return [
            'id'
        ];
    }

    protected $fillable = [
        'id',
        'parent_id',

        'company_id',
        'branch_id',
        'currency_id',

        'name',
        'code', // should be related to parent
        'description',
        'notes',

        'natural', //credit/debit
        'freeze', // frozen
        'final',// no childs
    ];


    public static function boot(){
        parent::boot();
        self::saving(function($modal){
            $modal->level = AccountHelper::getAccountLevel($modal->parent_id);

            //merge the parent code with child and skip if it afeard merge
            $parent = Account::find($modal->parent_id);
            if($parent != null)
            if(!Str::startsWith($modal->code, $parent->code)){
                $modal->code = $parent->code . $modal->code;
            }
        });
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function ledgers()
    {
        return $this->morphMany(Ledger::class, 'ledgerable');
    }

    public function children()
    {
        return $this->hasMany(Account::class, 'parent_id', 'id');
        //->withCount('children as childrenCount')->where('childrenCount','>',0)
    }

}
