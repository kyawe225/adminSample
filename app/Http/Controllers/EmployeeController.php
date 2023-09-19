<?php

namespace App\Http\Controllers;

use \Exception;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class EmployeeController extends Controller
{
    public function __construct(){

    }
    public function index(int $page=1){
        $employee=Employee::all();
        return $this->successResponse($employee);
    }
    public function create(){
        // not useable for api link!!!!!
    }
    public function update(int $id,EmployeeRequest $request){
        $data=[];
        $p=$request->validated();
        $data["Full name"]= isset($p['full_name']) ? $p['full_name'] : null;
        $data["email"] = isset($p['email'])? $p['email']:null;
        $data["phone"] = isset($p['phone'])?$p['phone']:null;
        $data["CompanyID"] = isset($p['company_id'])?$p['company_id']:null;
        try{
            $employee=Employee::where('id',$id)->exists();
            if($employee){
                DB::table('employees')->update($data);
                // Log::info("Successfully Created Employee by ".auth()->user()->name);
                return $this->successResponse("Updated Employee Successfully");
            }
            Log::debug("Employee not found");
            return $this->errorResponse("Employee not found",404);
        }catch(Exception $e){
            Log::debug($e->getTraceAsString()."\n".$e->getMessage());
            return $this->errorResponse("Your Employee update not successfully!");
        }
    }
    public function edit(int $id){
        $employee=Employee::where("id",$id)->first();
        if($employee==null){
            return $this->errorResponse("Employee Not Found",404);
        }
        return $this->successResponse($employee);
    }
    public function show(int $id){
        $employee=Employee::where("id",$id)->first();
        if($employee==null){
            return $this->errorResponse("Employee Not Found",404);
        }
        return $this->successResponse($employee);
    }
    public function store(EmployeeRequest $request){
        $data=[];
        $p=$request->validated();
        $data["Full name"]= isset($p['full_name']) ? $p['full_name'] : null;
        $data["email"] = isset($p['email'])? $p['email'] : null;
        $data["phone"] = isset($p['phone'])?$p['phone']:null;
        $data["CompanyID"]=isset($p['company_id'])? $p["company_id"]:null;
        try{
            Employee::create($data);
            return $this->successResponse("Employee Create Successfully");
        }catch(Exception $e){
            Log::debug($e->getTraceAsString()."\n".$e->getMessage());
            return $this->errorResponse("Your employee creation is not successfully.");
        }
    }
    public function destory(int $id){
        $success=Employee::where("id",$id)->delete();
        if($success>1){
            $this->successResponse("Deleted Employee Successfully!");
        }else{
            $this->errorResponse("Already Deleted Employee !");
        }
    }
}
