@extends('layouts.app')

@section('content')
    <div class="card">

        <div class="card-header">Companies <a href="/createcompany">
                <span class="fa fa-plus float-right"></span>
            </a> </div>

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

                @if(count($companies)>0)
                @foreach($companies as $company)
                    <tr>
                        <td><a href="company/{{$company->id}}">
                                @if($company->logo)
                                    <img src="{{ URL::to('/') }}/comapniesLogo/{{$company->logo}}" class="img-thumbnail mr-1 p-0" style="max-width: 27px;max-height: 27px;padding: 1px !important;" >
                                @endif
                                {{$company->name}}</a></td>
                        <td>{{$company->email}}</td>
                        <td>{{$company->website}}</td>
                        <td>


                            <a href="/company/update/{{$company->id}}"><i class="fa fa-edit"></i></a>
                            <a href="{{ action('CompanyController@destroy',$company->id),'/destroy' }}"onclick="if(!confirm('Do you Delete This Company ?')) return false"><i class="fa fa-trash"></i></a>

                        </td>
                    </tr>
                @endforeach
                @else
                    <td colspan="6" class="text-danger text-center fa-2x"> No Companies..!!</td>
                @endif
                </tbody>
            </table>
        </div>
        <div class="pagination col-lg-12 center-block">
            {!! $companies->render() !!}
        </div>
    </div>

    @endsection