@extends('adminlte::page')
@section('plugins.Datatables', true)
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2>Lista de Empleados @can('employee.create')<a class="btn btn-default" href="{{route('employee.create')}}"><i class="fas fa-user-plus" style="color: #db0202"></i></a> @endcan</h2></div>

                <div class="card-body">

                    @include('custom.message')

                    <table class="table table-hover datable">
                        <thead>

                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Empresa</th>
                            <th scope="col">correo</th>
                            <th scope="col">telefono</th>
                            <th colspan="col">Editar</th>
                            <th colspan="col">Desvincular</th>

                        </thead>

                        @foreach ($employees as $key=> $employee)
                            <tr>
                                <th scope="row">{{ $key+1}}</th>
                                <td>{{ $employee->first_name}}</td>
                                <td>{{ $employee->last_name}}</td>
                                <td>{{ $employee->company->name}}</td>
                                <td>{{ $employee->email}}</td>
                                <td>{{ $employee->phone}}</td>
                                <td>
                                    @can('employee.edit')
                                        <a class="btn btn-success" href="{{ route('employee.edit',$employee->id)}}"><i class="fas fa-edit"></i></a>
                                    @endcan
                                </td>
                                <td>
                                    @can('employee.destroy')
                                        <form action="{{ route('employee.destroy',$employee->id)}}" method="POST">
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
