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

        <form action="/createcompany" method="post" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required value="{{Request::old('name')}}">
            </div>

            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" class="form-control" required value="{{Request::old('email')}}">
            </div>

            <div class="form-group">
                <label>Website</label>
                <input type="url" name="website" class="form-control" required value="{{Request::old('website')}}">
            </div>

            <div class="form-group">
                <label>Logo</label>
                <input type="file" name="logo" class="form-control" required value="{{Request::old('logo')}}">
            </div>

            <input type="submit" class="btn btn-primary btn-lg" value="Create">
        </form>
    </div>



    @endsection
