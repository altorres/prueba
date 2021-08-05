@extends('layouts.app')
@section('title') Agregar Usuario @endsection
@section('nombre') Agregar usuario @endsection
@section('ruta') Agregar @endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>Agregar Usuario</h2></div>

                    <div class="card-body">
                        @include('custom.message')
                        <form action="{{ route('user.store')}}" method="POST">
                            @csrf


                            <div class="container">
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                           id="name"
                                           placeholder="Nombre Completo"
                                           name="name"
                                           required
                                           value="{{ old('name')}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <input type="email"
                                           class="form-control"
                                           id="email"
                                           placeholder="Correo Electronico"
                                           name="email"
                                           required
                                           value="{{ old('email' )}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <input type="password"
                                           class="form-control"
                                           id="password"
                                           required
                                           placeholder="Contraseña"
                                           name="password"

                                    >
                                    <div class="form-group has-feedback">
                                        <input type="password" class="form-control" placeholder="Confirmar Contraseña" name="password_confirmation"/>
                                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select  class="form-control"  name="roles" id="roles" required>
                                        <option value=""> Seleccionar</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}"
                                                    @isset($user->roles[0]->name)
                                                        @endisset

                                            >{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <hr>
                                <input class="btn btn-primary" type="submit" value="Guardar">









                            </div>




















                        </form>








                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
