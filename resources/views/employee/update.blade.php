@extends('layouts.app')

@section('content')

    <div class="container">
        @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2>Add Employee</h2>

        <form action="/employee/update/{{$employee->id}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="form-group">
                <label>Fisrt Name</label>
                <input type="text" name="firstName" class="form-control" required value="{{$employee->firstName}}">
            </div>

            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lastName" class="form-control" required value="{{$employee->lastName}}">
            </div>

            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" class="form-control" required value="{{$employee->email}}">
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input type="number" name="phone" class="form-control" min="11" required value="{{$employee->phone}}">
            </div>

            <div class="form-group">
                <label>Company</label>
                <select name="company" id="" required>
                    <option disabled selected >- Compant Name -</option>
                    @foreach($companies as $company)
                        <option value="{{$company->id}}" @if($employee->company_id ==$company->id) selected @endif>{{$company->name}}</option>
                    @endforeach

                </select>
            </div>

            <input type="submit" class="btn btn-primary btn-lg" value="Update">
        </form>
    </div>



@endsection
