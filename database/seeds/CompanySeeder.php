<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company1 = \App\Company::firstOrCreate(
            [
                'name' => [
                    'en' => 'Mfahem',
                    'ar' => 'مفاهيم',
                ],
            ]
        );


//        $company1 = \App\Company::first();
//        echo  $company1->id;

//        dump($company1);
$branch1 = \App\Branch::firstOrCreate(
    [
        'company_id' => $company1->id,
        'name' => [
            'en' => 'MAin Mafhem Branch',
            'ar' => 'فرع مفاهيم الرئيسي',
        ],
    ]
);

        $currency = \App\Currency::firstOrCreate(
            [
                'company_id' => $company1->id,

                'name' => [
                    'en' => 'Riyal',
                    'ar' => 'ريال',
                ],
                'code' => 'SAR',
                'rate' => 1,
                'precision' => 1,
                'symbol' => 1,
                'symbol_first' => 1,
                'decimal_mark' => '.',
                'thousands_separator' => ',',

            ]
        );
        $company1->currency_id = $currency->id;

//        $company1->Branches()->firstOrCreate(
//            [
//                'name' => [
//                    'en' => 'MAin Mafhem Branch',
//                    'ar' => 'فرع مفاهيم الرئيسي',
//                ],
//            ]
//        );

        $company2 = \App\Company::query()->firstOrCreate(
            [
                'name' => [
                    'en' => 'Alkshim',
                    'ar' => 'الكشيم',
                ],
            ]
        );


        $company2->Branches()->firstOrCreate(
            [
                'name' => [
                    'en' => 'MAin Alkshim Branch',
                    'ar' => 'فرع الكشيم الرئيسي',
                ],
            ]
        );

        $currency = \App\Currency::firstOrCreate(
            [
                'company_id' => $company2->id,

                'name' => [
                    'en' => 'Riyal',
                    'ar' => 'ريال',
                ],
                'code' => 'SAR',
                'rate' => 1,
                'precision' => 1,
                'symbol' => 1,
                'symbol_first' => 1,
                'decimal_mark' => '.',
                'thousands_separator' => ',',

            ]
        );
    }
}
