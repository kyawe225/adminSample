<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Support\Facades\Log;
use \Exception;

class CompanyController extends Controller
{
    public function __construct()
    {

    }
    public function index(int $page=1)
    {
        $company = Company::all();
        return $this->successResponse($company);
    }
    public function create()
    {
        // not useable for api link!!!!!
    }
    public function update(int $id, CompanyRequest $request)
    {
        $data=[];
        $p=$request->validated();
        $data["email"]= isset($p['email']) ? $p['email'] : null;
        $data["Name"] = $p['name'];
        $data["website"] = isset($p['website'])?$p['website']:null;
        $data["logo"] = isset($p['logo']) ? $p['logo']:null;
        try {
            $company = Company::where('id', $id)->first();
            if ($company != null) {
                $company->Name = $data["Name"];
                $company->logo = $data['logo'];
                $company->email = $data["email"];
                $company->website = $data["website"];
                $company->save();
                // Log::info("Successfully Created Company by " . auth()->user()->name);
                return $this->successResponse("Updated Company Successfully");
            }
            Log::debug("Company not found");
            return $this->errorResponse("Company not found", 404);
        } catch (Exception $e) {
            Log::debug($e->getTraceAsString()."\n".$e->getMessage());
            return $this->errorResponse("Your Company update not successfully!");
        }
    }
    public function edit(int $id)
    {
        $company = Company::where("id", $id)->first();
        if ($company == null) {
            return $this->errorResponse("Company Not Found", 404);
        }
        return $this->successResponse($company);
    }

    public function show(int $id)
    {
        $company = Company::where("id", $id)->first();
        if ($company == null) {
            return $this->errorResponse("Company Not Found", 404);
        }
        return $this->successResponse($company);
    }

    public function store(CompanyRequest $request)
    {
        $data=[];
        $p=$request->validated();
        $data["email"]= isset($p['email']) ? $p['email'] : null;
        $data["Name"] = $p['name'];
        $data["website"] = isset($p['website'])?$p['website']:null;
        $data["logo"] = isset($p['logo']) ? $p['logo']:null;
        try {
            Company::create($data);
            return $this->successResponse("Company Create Successfully.");
        } catch (Exception $e) {
            Log::debug($e->getTraceAsString()."\n".$e->getMessage());
            return $this->errorResponse("Your Company creation is not successfully.");
        }
    }
    public function destory(int $id)
    {
        $success = Company::where("id", $id)->delete();
        if ($success > 1) {
            $this->successResponse("Deleted Company Successfully!");
        } else {
            $this->errorResponse("Already Deleted Company !");
        }
    }
}
