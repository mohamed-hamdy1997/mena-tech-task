@extends('layouts.app')

@section('content')
    <div class="card">

        <div class="card-header">{{$company->name}} Company </div>

        <div class="card-body">

            <table class="table table-borderless table-striped table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Website</th>
                    <th>Control</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                                @if($company->logo)
                                    <img src="{{ URL::to('/') }}/comapniesLogo/{{$company->logo}}" class="img-thumbnail mr-1 p-0" style="max-width: 27px;max-height: 27px;padding: 1px !important;" >
                                @endif
                                {{$company->name}}</td>
                        <td>{{$company->email}}</td>
                        <td>{{$company->website}}</td>
                        <td>


                            <a href="/company/update/{{$company->id}}"><i class="fa fa-edit"></i></a>
                            <a href="{{ action('CompanyController@destroy',$company->id),'/destroy' }}"onclick="if(!confirm('Do you Delete This Company ?')) return false"><i class="fa fa-trash"></i></a>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    @endsection