<?php

use Illuminate\Database\Seeder;
use App\Account;
use App\Company;
class AccountSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accounts = [
            // parent
            [
                'name'=>'Account A1',
                'code'=>'10',
                'description'=>'description',
                'notes'=>'notes',
                'natural'=>0,
                'final'=>0,
                'children'=>[
                    //sub level 1
                    [
                        'name' => 'Account AA1',
                        'code' => '1010',
                        'description' => 'description',
                        'notes' => 'notes',
                        'natural' => 0,
                        'final' => 0,
                    ],
                    // sub level 2
                    [
                        'name' => 'Account AAA1',
                        'code' => '101010',
                        'description' => 'description',
                        'notes' => 'notes',
                        'natural' => 0,
                        'final' => 0,
                    ],
                    // sub level 3
                    [
                        'name' => 'Account AAAA1',
                        'code' => '10101010',
                        'description' => 'description',
                        'notes' => 'notes',
                        'natural' => 0,
                        'final' => 0,
                    ],
                ]
            ],
           
            // parent
            [
                'name' => 'Account B1',
                'code' => '20',
                'description' => 'description',
                'notes' => 'notes',
                'natural' => 0,
                'final' => 1,
            ],
            // parent
            [
                'name' => 'Account C1',
                'code' => '30',
                'description' => 'description',
                'notes' => 'notes',
                'natural' => 0,
                'final' => 1,
            ],
            // parent
            [
                'name' => 'Account D1',
                'code' => '40',
                'description' => 'description',
                'notes' => 'notes',
                'natural' => 0,
                'final' => 1,
            ],
        ];



        $this->createAccount ($accounts , null);

    }

    public function createAccount($accounts,$parent){

        $company = Company::first();
        $branch  = $company->Branches;
        $currency  = $company->Currencies;

        foreach ($accounts as $value) {
            if ($value != null)
            {

                $value['parent_id'] = $parent;
                $value['company_id'] = $company->id ?? '111';
                $value['branch_id'] = $branch[0]->id ?? '222';
                $value['currency_id'] = $currency[0]->id ?? '333';
                $children = null;

                if(isset($value['children'])){
                    $children = $value['children'] ;
                    unset($value['children']);
                }

                
               $account = Account::firstOrCreate($value);
               if($children!=null){
                    $this->createAccount($children, $account->id);
               }
            }
        }
    }
}
