<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    public $translatable = ['name'];
    public $with = ['branches', 'Currencies', 'projects', 'employees', 'Accounts', 'journals', 'sections', 'contacts', 'letters', 'tasks'];

    protected $fillable = [
        'id',
        'name',
        'currency_id',
        'country_id',
    ];


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


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function projects()
    {
        return $this->hasMany('App\Project')->with('employees');
    }

    public function employees()
    {
        return $this->hasMany('App\Employee');
    }

    public function sections()
    {
        return $this->hasMany('App\Section');
    }

    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

    public function letters()
    {
        return $this->hasMany('App\Letter');
    }

    public function Branches()
    {
        return $this->hasMany(Branch::class , 'company_id', 'id');
    }

    public function Currencies()
    {
        return $this->hasMany(Currency::class, 'company_id', 'id');
    }


    public function Currency()
    {
        return $this->belongsTo(Currency::class);
    }

    //Niypoo
    public function Accounts()
    {
        return $this->belongsTo(Account::class);
    }
    
    public function journals()
    {
        return $this->hasMany(Journal::class, 'company_id', 'id')->with('ledgers');
    }

    public function ledgers()
    {
        return $this->hasMany(Ledger::class, 'company_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class)->where('category_id',null);
    }
   
    public function products()
    {
        return $this->hasMany(Product::class)->with('media','category');
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

}
