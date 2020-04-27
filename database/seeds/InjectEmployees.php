<?php

use Illuminate\Database\Seeder;
use App\Company;
use App\Employee;

class InjectEmployees extends Seeder
{

    public function correctDate($date){
        if($date){
            return DateTime::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        }
     }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = Company::first();
        $row = 1;
        $importCount = 1000;
        $splitSymbol = ',';
        if (($handle = fopen(public_path("/employees.csv"), "r")) !== FALSE) {
            while (($data = fgetcsv($handle, $importCount, $splitSymbol)) !== FALSE) {
                //skip frist one
                if($row != 1)
                {
    
    
                    $iqama_number = $data[0];
                    $name = $data[1];
                    $gender = $data[2];
                    $nationality = $data[3];
                    $occupation = $data[4];
                    $passport_number = $data[5];
                    $passport_expiry_date_hijri = $this->correctDate($data[6]);
                    $passport_expiry_date_gregorian =  $this->correctDate($data[7]);
                    $iqama_expiry_date_hijri =  $this->correctDate($data[8]);
                    $iqama_expiry_date_gregorian =  $this->correctDate($data[9]);
                    $status = $data[10];


                    Employee::create([
                       'iqama_number'=>$iqama_number, 
                       'name'=>$name, 
                       'company_id'=> $company->id,
                       'gender'=>$gender, 
                       'nationality'=>$nationality, 
                       'occupation'=>$occupation, 
                       'passport_number'=>$passport_number, 
                       'passport_expiry_date_hijri'=>$passport_expiry_date_hijri, 
                       'passport_expiry_date_gregorian'=>$passport_expiry_date_gregorian, 
                       'iqama_expiry_date_hijri'=>$iqama_expiry_date_hijri, 
                       'iqama_expiry_date_gregorian'=>$iqama_expiry_date_gregorian, 
                       'status'=>$status
                    ]);
    
                }
                $row++;
            }
            fclose($handle);
        }
    
    }
}
