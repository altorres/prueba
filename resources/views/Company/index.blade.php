@extends('adminlte::page')
@section('plugins.Datatables', true)
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><h2>Lista de Empresas @can('company.create')<a class="btn btn-default" href="{{route('company.create')}}"><i class="fas fa-user-plus" style="color: #db0202"></i></a> @endcan</h2></div>

                <div class="card-body">

                    @include('custom.message')

                    <table class="table table-hover datable">
                        <thead>

                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th colspan="col">Ver</th>
                            <th colspan="col">Editar</th>
                            <th colspan="col">inabilitar</th>

                        </thead>

                        @foreach ($companies as $key=> $company)
                            <tr>
                                <th scope="row">{{ $key+1}}</th>
                                <td>{{ $company->name}}</td>
                                <td>{{ $company->email}}</td>
                                <td>
                                    @can('company.show')
                                        <a class="btn btn-info" href="{{ route('company.show',$company->id)}}"><i class="fas fa-eye"></i></a>
                                    @endcan
                                </td>
                                <td>
                                    @can('company.edit')
                                        <a class="btn btn-success" href="{{ route('company.edit',$company->id)}}"><i class="fas fa-edit"></i></a>
                                    @endcan
                                </td>
                                <td>
                                    @can('company.destroy')
                                        <form action="{{ route('company.destroy',$company->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger"><i class="fas fa-times" ></i></button>
                                        </form>
                                    @endcan
                                </td>
                              </tr>
                        @endforeach






                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('.datable').DataTable({
        stateSave: true,
        ordering: true,
        select:true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
    });
</script>
@endsection
