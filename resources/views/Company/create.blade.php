@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>Agregar Empresa</h2></div>

                    <div class="card-body">
                        @include('custom.message')
                        <form action="{{ route('company.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="container">
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                           id="name"
                                           placeholder="Nombre Empresa"
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
                                           value="{{ old('email' )}}"
                                    >
                                </div>
                                <div class="form-group">
                                    <input type="website"
                                           class="form-control"
                                           id="website"
                                           placeholder="website"
                                           name="website"
                                           value="{{ old('website' )}}"
                                    >
                                </div>
                                <div class="form-group">

                                    <div class="form-group" id="logo" >
                                        <span>Logo </span>
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="col-md-8"><input type="file" name="logo" class="form-control logo" id="logo" ></div>
                                            </div>
                                            <div class="col-4">
                                                <center><img class=" img-thumbnail image" id="image" style="width: 70%" src="{{url('imagenes/default.png')}}"></center>
                                            </div>

                                        </div>
                                    </div>
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
        $(".logo").change(function(){
        var imagen=this.files[0];
        /*=============================================
        =            validar foto        =
        =============================================*/
        var datosImagen= new FileReader;
        datosImagen.readAsDataURL(imagen);
        $(datosImagen).on("load",function(event){
        var rutaImagen=event.target.result;
        $(".image").attr("src",rutaImagen);
        })
        })
    </script>
@endsection
