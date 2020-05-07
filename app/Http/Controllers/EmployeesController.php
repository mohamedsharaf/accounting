<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use DateTime;
use Carbon\Carbon;
use File;
class EmployeesController extends Controller
{
    public function getAll($company){
        $employees = Employee::where([
            ['company_id', $company],
            ['trash',0]
        ])
        ->orderBy('iqama_expiry_date_gregorian')
        ->get();
        return response()->json($employees, 200);
    }
    public function trash($company){
        $employees = Employee::where([
            ['company_id', $company],
            ['trash', 1]
        ])
        ->orderBy('iqama_expiry_date_gregorian')
        ->get();
        return response()->json($employees, 200);
    }


    public function get(Employee $employee)
    {
        $employee['projects']= $employee->projects;
        $employee['sections']= $employee->sections;
        $employee['holidays']= $employee->holidays;
        $employee['tasks']= $employee->tasks;

        return response()->json($employee, 200);
    }

    public function removeFromProject(Employee $employee, $project)
    {
        try{
            $employee->projects()->detach($project);
            return response()->json(true, 200);
        }
        catch(\Exception $e){
            return response()->json($e, 422);
        }
    }

    public function store(Request $request)
    {
        try{
            $employee = new Employee();
            $employee->company_id = $request->company_id;
            $employee->section_id = $request->section_id;
            $employee->name = $request->name;
            $employee->gender = $request->gender;
            $employee->nationality = $request->nationality;
            $employee->passport_number = $request->passport_number;
            $employee->iqama_number = $request->iqama_number;
            $employee->occupation = $request->occupation;
            $employee->passport_expiry_date_hijri = new DateTime($request->passport_expiry_date_hijri);
            $employee->passport_expiry_date_gregorian = new DateTime($request->passport_expiry_date_gregorian);
            $employee->iqama_expiry_date_hijri =  new DateTime($request->iqama_expiry_date_hijri);
            $employee->iqama_expiry_date_gregorian = new DateTime($request->iqama_expiry_date_gregorian);
            $employee->insurance_status = $request->insurance_status;
            $employee->insurance_expiry = new DateTime($request->insurance_expiry);
            $employee->status = 'valid';
            $employee->save();
            return response()->json($employee, 200);
        }
        catch(\Exception $e){
            return response()->json($e, 422);
        }
    }

    public function update(Employee $employee, Request $request)
    {
        $employee->section_id = $request->section_id;
        $employee->name = $request->name; 
        $employee->gender = $request->gender; 
        $employee->nationality = $request->nationality; 
        $employee->passport_number = $request->passport_number; 
        $employee->iqama_number = $request->iqama_number; 
        $employee->occupation = $request->occupation; 
        $employee->passport_expiry_date_hijri = new DateTime($request->passport_expiry_date_hijri); 
        $employee->passport_expiry_date_gregorian = new DateTime($request->passport_expiry_date_gregorian); 
        $employee->iqama_expiry_date_hijri =  new DateTime($request->iqama_expiry_date_hijri); 
        $employee->iqama_expiry_date_gregorian = new DateTime($request->iqama_expiry_date_gregorian); 
        $employee->insurance_status = $request->insurance_status; 
        $employee->insurance_expiry = new DateTime($request->insurance_expiry);
        $employee->save();
        return response()->json(true, 200);
    }

    public function softDelete(Employee $employee)
    {
        $employee->trash = ($employee->trash ? 0 : 1);
        $employee->save();
        return response()->json(true, 200);
    }

    public function delete(Employee $employee)
    {
        if($employee){
            $employee->delete();
            return response()->json(true, 200);
        }

        return response()->json(false, 422);
    }

    public function incrementIqama(Employee $employee){
        try{

            $iqama_date_grg =  Carbon::parse($employee['iqama_expiry_date_gregorian'])->addYears(1);
            $iqama_date_hij =  Carbon::parse($employee['iqama_expiry_date_hijri'])->addYears(1);

            $employee->iqama_expiry_date_gregorian = $iqama_date_grg->format('Y-m-d');
            $employee->iqama_expiry_date_hijri = $iqama_date_hij->format('Y-m-d');
            $employee->save();

            return response()->json($employee, 200);
        }
        catch(\Exception $e){
            return response()->json($e, 422);
        }


        return response()->json('false', 422);
    }

    public function correctDate($date)
    {
        if ($date) {
            return DateTime::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        }
    }

    public function importFromCSVFile(Request $request){
        //check if there is file or not
        if(!$request->hasFile('file')) return response()->json('missing-file', 422);
        //read file from request
        $file = $request->file('file');
        //get file cach path
        $pathFile = $file->getRealPath();
        //open file
        $handle  = fopen($pathFile, "r");
        //check if opened as well
        if(!$handle) return response()->json('something-went-wrong', 422);
        
        try{
            $row = 1; //first row to skip title header of field
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                //skip frist one
                if ($row != 1) {

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

                    //get first or create new one
                    $employee = Employee::firstOrNew(['iqama_number' => $iqama_number,]);
                    //update all data
                    $employee->update([
                        // 'iqama_number' => $iqama_number,
                        'name' => $name,
                        'company_id' => 1,
                        'gender' => $gender,
                        'nationality' => $nationality,
                        'occupation' => $occupation,
                        'passport_number' => $passport_number,
                        'passport_expiry_date_hijri' => $passport_expiry_date_hijri,
                        'passport_expiry_date_gregorian' => $passport_expiry_date_gregorian,
                        'iqama_expiry_date_hijri' => $iqama_expiry_date_hijri,
                        'iqama_expiry_date_gregorian' => $iqama_expiry_date_gregorian,
                        'status' => $status
                    ]);
                }
                $row++;
            }
            //close file
            fclose($handle);
            //return true
            return response()->json(true, 200);
        }
        catch(\Exception $e){
            return response()->json('dddd', 422);
        }
    }
}
