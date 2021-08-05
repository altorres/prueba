@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>{{$company->name}}</h2> @can('company.edit')
                            <a class="btn btn-success" href="{{ route('company.edit',$company->id)}}"><i class="fas fa-edit"></i></a>
                        @endcan</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <span><b>Correo Electronico</b></span>
                                <p>{{$company->email}}</p>
                                <span><b>Website</b></span>
                                <p>{{$company->website}}</p>

                            </div>
                            <div class="border-left d-sm-none d-md-block" style="width: 0px;"></div>
                            <div class="col-md-6" style="margin-left: -1px;">
                                <p><b>Logo</b></p>
                                <img src="{{$company->get_Logo}}" width="50%">
                            </div>
                        </div>









                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
