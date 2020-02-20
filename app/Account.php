<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public $translatable = ['name'];

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

}
