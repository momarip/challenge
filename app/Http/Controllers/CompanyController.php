<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:company-list|company-create|company-edit|company-delete', ['only' => ['index','show']]);
         $this->middleware('permission:company-create', ['only' => ['create','store']]);
         $this->middleware('permission:company-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:company-delete', ['only' => ['destroy']]);
    }
    
    public function get_all_companies(){
        $companies = Company::orderBy('id', 'DESC')->get();

        return response()->json([
            'companies' => $companies
        ], 200);
    }

    public function create_company(Request $request){
        $this->validate($request, [
            'name' => 'required'
        ]);

        $company = new Company();
        $company->name = $request->name;
        $company->type = $request->type;
        $company->description = $request->description;
        $company->save();
    } 

    public function update_company(Request $request, $id){
        $company = Company::find($id); 
        $this->validate($request, [
            'name' => 'required'
        ]);

        $company->name = $request->name;
        $company->type = $request->type;
        $company->description = $request->description;
        $company->save();
    } 

    public function delete_company (Request $request, $id){
        $company = Company::findOrFail($id);
        $company->delete();
    }
}
