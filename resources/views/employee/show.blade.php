@extends('layouts.app')

@section('content')
    <div class="card">

        <div class="card-header">Employees  <a href="/addemployee">
                <span class="fa fa-plus float-right"></span>
            </a></div>

        <div class="card-body">

            <table class="table table-borderless table-striped table-hover">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>E-mail</th>
                    <th>Phone</th>
                    <th>Company</th>
                    <th>Control</th>
                </tr>
                </thead>
                <tbody>
                @if(count($employees)>0)
                @foreach($employees as $employee)
                    <tr>
                        <td>{{$employee->firstName}}</td>
                        <td>{{$employee->lastName}}</td>
                        <td>{{$employee->email}}</td>
                        <td>{{$employee->phone}}</td>
                        <td><a href="company/{{$employee->company->id}}">{{$employee->company->name}}</a></td>
                        <td>
                            <a href="/employee/update/{{$employee->id}}"><i class="fa fa-edit"></i></a>
                            <a href="{{ action('EmployeeController@destroy',$employee->id),'/destroy' }}"onclick="if(!confirm('Do you Delete This Employee ?')) return false"><i class="fa fa-trash"></i></a>

                        </td>
                    </tr>
                @endforeach
                    @else
                    <td colspan="6" class="text-danger text-center fa-2x"> No Employee..!!</td>
                @endif
                </tbody>
            </table>
        </div>
        <div class="pagination col-lg-12 center-block">
            {!! $employees->render() !!}
        </div>
    </div>

    @endsection