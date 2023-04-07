<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    
    public function get_all_employees(){
        $employees = User::where('is_admin', false)->get();

        return response()->json([
            'employees' => $employees
        ], 200);
    }

    public function create_employee(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required'
        ]);

        $employee = new User();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->is_admin = $request->is_admin;
        $employee->save();
    } 

    public function update_employee(Request $request, $id){
        $employee = User::find($id); 
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required'
        ]);

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->is_admin = $request->is_admin;
        $employee->save();
    } 

    public function delete_employee (Request $request, $id){
        $employee = User::findOrFail($id);
        $employee->delete();
    }
}
