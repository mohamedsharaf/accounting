<?php

use Illuminate\Database\Seeder;
use App\Company;
use App\Category;
use App\Client;
use App\Product;
use Spatie\MediaLibrary\Models\Media;
class POS extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $company = Company::first();
        $branch  = $company->Branches;

        for ($i=0; $i < 10; $i++) { 
            Client::create(
                [
                    'company_id'=> $company->id,
                    'branch_id'=> $branch[0]->id,
                    'name'=>'Client '. $i,
                    'mobile'=> '0000001' .$i,
                    'email'=>'client'. $i.'@emial.com',
                    'address'=> '2A street 4floor',
                ]
            );
        }

        $categories = [
            // parent
            [
                'title' => 'ايس كريم',
                'children' => [
                    //sub level 1
                    [
                        'title' => 'كوبايات',
                        "products" => [
                            ['title' => 'فانليا',  'quantity' => 3, 'price' => 10],
                            ['title' => 'مستكه',  'quantity' => 4, 'price' => 2],
                            ['title' => 'فسدق',  'quantity' => 5, 'price' => 4],
                            ['title' => 'بندق',  'quantity' => 8, 'price' => 7],
                            ['title' => 'زبادي',  'quantity' => 6, 'price' => 8],
                            ['title' => 'بطيخ',  'quantity' => 3, 'price' => 9],
                        ]
                    ],
                    //sub level 1
                    [
                        'title' => 'بسكويت',
                        "products" => [
                            [ 'title'=> 'فانليا',  'quantity'=> 4, 'price'=> 12 ],
                            [ 'title'=> 'مستكه',  'quantity'=> 3, 'price'=> 20 ],
                            [ 'title'=> 'فسدق',  'quantity'=> 6, 'price'=> 40 ],
                            [ 'title'=> 'بندق',  'quantity'=> 7, 'price'=> 10 ],
                            [ 'title'=> 'زبادي',  'quantity'=> 2, 'price'=> 9 ],
                            [ 'title'=> 'بطيخ',  'quantity'=> 1, 'price'=> 20 ],
                        ]
                    ]
                ],
            ]
        ];
       

        $this->insertPOSData($categories, null);
    }



    public function insertPOSData($data, $parent)
    {

        $company = Company::first();
        $branch  = $company->Branches;
        // $currency  = $company->Currencies;

        foreach ($data as $value) {
            if ($value != null) {

                $value['category_id'] = $parent;
                $value['company_id']  = $company->id;
                $value['branch_id']   = $branch[0]->id;
                // $value['currency_id'] = $currency[0]->id;
                $products = null;
                $children = null;

                if (isset($value['products'])) {
                    $products = $value['products'];
                    unset($value['products']);
                }

                if (isset($value['children'])) {
                    $children = $value['children'];
                    unset($value['children']);
                }

                $category = Category::firstOrCreate($value);
                
                //insert items/products
                if($products != null)
                foreach ($products as $item) {
                    if($item){
                        $item['company_id'] = $company->id;
                        $item['branch_id'] = $branch[0]->id;
                        // $item['currency_id'] = $currency[0]->id;
                        $product  = $category->products()->firstOrCreate($item);
                       $product->addMedia(public_path('dummy/3.jpg'))->preservingOriginal()->toMediaCollection('file');
                    }
                }
                
                if ($children != null) 
                $this->insertPOSData($children, $category->id);
                
            }
        }
    }
}
