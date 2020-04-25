<?php

use Illuminate\Database\Seeder;
use App\HolidayType;
class HolidayTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HolidayType::create([
            'name' => [
                'ar' => 'سنوي',
                'en' => 'Yearly'
            ],
        ]);
        HolidayType::create([
            'name' => [
                'ar' => 'مرضي',
                'en' => ''
            ],
        ]);
        HolidayType::create([
            'name' => [
                'ar' => 'ديني',
                'en' => ''
            ],
        ]);
    }
}
