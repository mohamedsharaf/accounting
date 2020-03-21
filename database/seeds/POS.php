<?php

use Illuminate\Database\Seeder;
use App\Company;
use App\Category;

class POS extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = [
            // parent
            [
                'title' => 'ايس كريم',
                'children' => [
                    //sub level 1
                    [
                        'title' => 'كوبايات',
                        "items" => [
                            ['title' => 'فانليا', 'img' => '1.jpg', 'quantity' => 3, 'price' => 10],
                            ['title' => 'مستكه', 'img' => '2.jpg', 'quantity' => 4, 'price' => 2],
                            ['title' => 'فسدق', 'img' => '3.jpg', 'quantity' => 5, 'price' => 4],
                            ['title' => 'بندق', 'img' => '1.jpg', 'quantity' => 8, 'price' => 7],
                            ['title' => 'زبادي', 'img' => '3.jpg', 'quantity' => 6, 'price' => 8],
                            ['title' => 'بطيخ', 'img' => '2.jpg', 'quantity' => 3, 'price' => 9],
                        ]
                    ],
                    //sub level 1
                    [
                        'title' => 'بسكويت',
                        "items" => [
                            [ 'title'=> 'فانليا', 'img'=> '1.jpg', 'quantity'=> 4, 'price'=> 12 ],
                            [ 'title'=> 'مستكه', 'img'=> '2.jpg', 'quantity'=> 3, 'price'=> 20 ],
                            [ 'title'=> 'فسدق', 'img'=> '3.jpg', 'quantity'=> 6, 'price'=> 40 ],
                            [ 'title'=> 'بندق', 'img'=> '1.jpg', 'quantity'=> 7, 'price'=> 10 ],
                            [ 'title'=> 'زبادي', 'img'=> '3.jpg', 'quantity'=> 2, 'price'=> 9 ],
                            [ 'title'=> 'بطيخ', 'img'=> '2.jpg', 'quantity'=> 1, 'price'=> 20 ],
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
        $currency  = $company->Currencies;

        foreach ($data as $value) {
            if ($value != null) {

                $value['parent_id'] = $parent;
                $value['company_id'] = $company->id;
                $value['branch_id'] = $branch[0]->id;
                $value['currency_id'] = $currency[0]->id;
                $items = null;
                $children = null;

                if (isset($value['items'])) {
                    $items = $value['items'];
                    unset($value['items']);
                }

                if (isset($value['children'])) {
                    $children = $value['children'];
                    unset($value['children']);
                }

                $category = Category::firstOrCreate($value);
                
                //insert items/products
                if($items != null)
                foreach ($items as $item) {
                    if($item){
                        $item['company_id'] = $company->id;
                        $item['branch_id'] = $branch[0]->id;
                        $item['currency_id'] = $currency[0]->id;
                        $category->items()->firstOrCreate($item);
                    }
                }
                
                if ($children != null) 
                $this->insertPOSData($children, $category->id);
                
            }
        }
    }
}
