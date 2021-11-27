
<h1>{{$modo}} Usuarios</h1>

    @if(count($errors)>0)

        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach($errors ->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
            
    @endif

    <div class="fondoFormulario">
        <div class="form-group" >
            <label for="Nombre">Nombre</label>
            <input type="text" name="Nombre" value="{{ isset($usuario->Nombre) ? $usuario->Nombre : old('Nombre')}}" id="Nombre" class="form-control">
        </div>

        <div class="form-group" >
            <label for="Apellidos">Apellidos</label>
            <input type="text" name="Apellidos" value="{{ isset($usuario->Apellidos) ? $usuario->Apellidos : old('Apellidos') }}" id="Apellidos" class="form-control">
        </div>

        <div class="form-group" >
            <label for="Edad">Edad</label>
            <input type="number" name="Edad" value="{{ isset($usuario->Edad) ? $usuario->Edad : old('Edad')}}" id="Edad" class="form-control">
        </div>

        <div class="form-group" >
            <label for="Email">Email</label>
            <input type="email" name="Email" value="{{ isset($usuario->Email) ? $usuario->Email : old('Email')}}" id="Email" class="form-control">
        </div>

        <div class="form-group" >
            <label for="Foto"></label>
            @if(isset($usuario->Foto))
            <td><img src="{{asset('storage').'/'.$usuario->Foto}}" alt="Img Usuario" width="100" class="img-thumbnail img-fluid"></td>
            <!-- {{$usuario->Foto}} -->
            @endif
            <br>
            <input type="file" name="Foto" value="" id="Foto">
        </div>
    </div>
    <br>
<input type="submit" value="{{$modo}}" class="btn btn-success btnSombras">
<a href="{{url('usuarios/')}}" class="btn btn-primary btnSombras" >Regresar a la lista</a>

