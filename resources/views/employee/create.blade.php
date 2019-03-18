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

        <h2>Create Company</h2>

        <form action="/addemployee" method="post" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="form-group">
                <label>Fisrt Name</label>
                <input type="text" name="firstName" class="form-control" required value="{{Request::old('firstName')}}">
            </div>

            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lastName" class="form-control" required value="{{Request::old('lastName')}}">
            </div>

            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" class="form-control" required value="{{Request::old('email')}}">
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input type="tel" name="phone" class="form-control" minlength="11" required value="{{Request::old('phone')}}">
            </div>

            <div class="form-group">
                <label>Company</label>
                <select name="company" id="" required>
                    <option disabled selected >- Compant Name -</option>

                    @foreach($companies as $company)
                        <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach

                </select>
            </div>

            <input type="submit" class="btn btn-primary btn-lg" value="Add">
        </form>
    </div>



    @endsection
