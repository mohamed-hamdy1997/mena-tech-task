<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function __construct(User $user)
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies =   Company::orderBy('id','desc')->paginate(10);
        return  view('company/show',compact('companies'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company/create');
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
            'name' => 'required',
            'email' => 'required |string|email|max:255| unique:companies',
            'website' => 'required|url',
            'logo' => 'required | image|max:3024 | mimes:jpg,png,jpeg,svg | dimensions:min_width=100,min_height=100',
        ]);

        $company = new Company();

            $filenameWithExtention = $request->file('logo')->getClientOriginalName();
            $fileName = pathinfo($filenameWithExtention, PATHINFO_FILENAME);
            $extension = $request->file('logo')->getClientOriginalExtension();
            $fileNameStoreImage = $fileName . '_' . time() . '.' . $extension;
            $path = $request->file('logo')->move(base_path() . '/public/comapniesLogo/', $fileNameStoreImage);

        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');
        $company->logo = $fileNameStoreImage;
        $company->save();

        return redirect('/companies');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('/company/showCompany',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('/company/update' , compact('company'));
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
            'name' => 'required',
            'email' => 'required |string|email|max:255',
            'website' => 'required|url',
            'logo' => 'nullable| image|max:3024 | mimes:jpg,png,jpeg,svg | dimensions:min_width=100,min_height=100',
        ]);

        $company = Company::findOrFail($id);
        $fileNameStoreImage = $company->logo;

        if ($request->hasFile('logo')) {
            Storage::delete('/public/comapniesLogo/'.$company->logo);
            $filenameWithExtention = $request->file('logo')->getClientOriginalName();
            $fileName = pathinfo($filenameWithExtention, PATHINFO_FILENAME);
            $extension = $request->file('logo')->getClientOriginalExtension();
            $fileNameStoreImage = $fileName . '_' . time() . '.' . $extension;
            $path = $request->file('logo')->move(base_path() . '/public/comapniesLogo/', $fileNameStoreImage);
        }

        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');
        $company->logo = $fileNameStoreImage;
        $company->update();

        return redirect('/companies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $employees = Employee::where('company_id', $id);
        Storage::delete('/public/comapniesLogo/'.$company->logo);
        $employees->delete();
        $company->delete();
        return redirect('/companies');
    }
}
