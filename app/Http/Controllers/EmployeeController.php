<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees =   Employee::orderBy('id','desc')->paginate(10);
        return  view('employee/show',compact('employees'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return view('/employee/create',compact('companies') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required |string|email|max:255| unique:employees',
            'phone' => 'required|regex:/(01)[0-9]{9}/',
            'company' => 'required'
        ]);

        $employee = new Employee();

        $employee->firstName = $request->input('firstName');
        $employee->lastName = $request->input('lastName');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->company_id = $request->input('company');
        $employee->save();
        return redirect('/employees');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Company::all();
        $employee  =Employee::findOrFail($id);
        return view('/employee/update',compact(['companies' , 'employee']));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required |string|email|max:255',
            'phone' => 'required|regex:/(01)[0-9]{9}/|min:11',
            'company' => 'required'
        ]);

        $employee = Employee::findOrFail($id);

        $employee->firstName = $request->input('firstName');
        $employee->lastName = $request->input('lastName');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->company_id = $request->input('company');
        $employee->update();
        return redirect('/employees');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect('/employees')->with('success' , 'Employee Deleted');
    }
}
