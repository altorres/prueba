@extends('layouts.app')
@section('title') Usuarios @endsection
@section('nombre') Index @endsection
@section('ruta')Index  @endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header"><h2>Lista de Usuarios @can('haveaccess','user.create')<a class="btn btn-default" href="{{route('user.create')}}"><i class="fas fa-user-plus" style="color: #db0202"></i></a> @endcan</h2></div>

                    <div class="card-body">


                        @include('custom.message')

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role(s)</th>
                                <th colspan="col">Ver</th>
                                <th colspan="col">Editar</th>
                                <th colspan="col">Eliminar</th>
                                <th colspan="col">Contraseña</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($users as $user)

                                <tr>
                                    <th scope="row">{{ $user->id}}</th>
                                    <td>{{ $user->name}}</td>
                                    <td>{{ $user->email}}</td>
                                    <td>
                                        @isset( $user->roles[0]->name )
                                            {{ $user->roles[0]->name}}
                                        @endisset

                                    </td>
                                    <td>
                                        @can('view',[$user, ['user.show','userown.show'] ])
                                            <a class="btn btn-info" href="{{ route('user.show',$user->id)}}"><i class="fas fa-user"></i></a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('view', [$user, ['user.edit','userown.edit'] ])
                                            <a class="btn btn-success" href="{{ route('user.edit',$user->id)}}"><i class="fas fa-user-edit"></i></a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('haveaccess','user.destroy')
                                            <form action="{{ route('user.destroy',$user->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger"><i class="fas fa-user-times" ></i></button>
                                            </form>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('view', [$user, ['user.edit','userown.edit'] ])
                                        <a class="btn btn-warning clickF" data-toggle="modal" data-target="#exampleModal" data-valor="{{'{"id":'.$user->id.'}'}}" href="#"><i class="fas fa-key"></i></a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form id="form1" method="post">
                                                    @csrf

                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Cambio de Contraseña</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="form-group has-feedback">
                                                                <input type="password" class="form-control" placeholder="Contraseña" name="password"/>
                                                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                                            </div>
                                                            <div class="form-group has-feedback">
                                                                <input type="password" class="form-control" placeholder="Confirmar Contraseña" name="password_confirmation"/>
                                                                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                        @endcan
                                    </td>

                                </tr>
                            @endforeach





                            </tbody>
                        </table>

                        {{ $users->links() }}




                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            $(".clickF").click(function(e) {
                e.preventDefault();
                var data = $(this).attr("data-valor");
                data = JSON.parse(data);
                var id=data.id;
                // $('.modal-body #nombre').val(data.nombreCompleto);
                // $('.modal-body #telefono').val(data.telefono);
                // $('.modal-body #celular').val(data.celular);
                // $('.modal-body #boton').val(data.tipo);
                document.getElementById("form1").action="user/password/"+(id);
                /*$.getJSON($(this).attr("data-valor"), {format: "json"}, function(data) {
                 $(".modal-body #nombreS").val(data[0].nombreS);
                 $("p").html(data[0].description);
                 });*/
                //$("").val( data );
            });
        </script>

    @endpush
@endsection
