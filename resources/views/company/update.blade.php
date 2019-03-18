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

        <form action="/company/update/{{$company->id}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required value="{{$company->name}}">
            </div>

            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" class="form-control" required value="{{$company->email}}">
            </div>

            <div class="form-group">
                <label>Website</label>
                <input type="url" name="website" class="form-control" required value="{{$company->website}}">
            </div>

            <div class="form-group">
                <label class="d-block">Logo</label>
                <input type="file" name="logo" class="form-control col-lg-4 d-inline-block" optional value="{{$company->logo}}">
                <img src="{{ URL::to('/') }}/comapniesLogo/{{$company->logo}}" class="img-thumbnail col-8 d-inline-block" alt="{{$company->logo}}" style="width:100px ;height:100px" >
            </div>

            <input type="submit" class="btn btn-primary btn-lg" value="Create">
        </form>
    </div>



@endsection
