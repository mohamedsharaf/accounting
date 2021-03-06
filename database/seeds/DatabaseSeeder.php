<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         $this->call(UsersTableSeeder::class);
//         $this->call(CurrencySeeder::class);
            $this->call(CompanySeeder::class);
//         $this->call(BranchSeeder::class);
            $this->call(AccountSeeder::class);
            $this->call(POS::class);
            $this->call(Roles::class);
        //$this->call(AccountSeeder::class);
        $this->call(InjectEmployees::class);
        $this->call(HolidayTypes::class);
    }
}
