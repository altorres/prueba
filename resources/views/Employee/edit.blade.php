@extends('adminlte::page')
@section('plugins.Select2', true)
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>Editar Empleado</h2></div>

                    <div class="card-body">
                        @include('custom.message')
                        <form action="{{ route('employee.update',$employee->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="container">
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                           id="first_name"
                                           placeholder="Nombres"
                                           name="first_name"
                                           required
                                           value="{{ old('first_name',$employee->first_name)}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                           id="last_name"
                                           placeholder="Apellido"
                                           name="last_name"
                                           required
                                           value="{{ old('last_name',$employee->last_name)}}"
                                    >
                                </div>

                                <div class="form-group">
                                    <select  class="form-control select"  name="company" id="company" required>
                                        <option value=""> Seleccionar empresa</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" {{ old('company',$employee->company_id) == $company->id ? 'selected' : '' }}
                                            @isset($employee->company->name)
                                                @endisset

                                            >{{ $company->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="email"
                                           class="form-control"
                                           id="email"
                                           placeholder="Correo Electronico"
                                           name="email"
                                           value="{{ old('email', $employee->email )}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <input type="text"
                                           class="form-control"
                                           id="phone"
                                           placeholder="Numero Telefono"
                                           name="phone"
                                           value="{{ old('phone',$employee->phone )}}"
                                    >
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

@section('js')
    <script>
        $(document).ready(function() {
            $('.select').select2();
        });

    </script>
@endsection
