@extends('layouts.app')

@section('content')
<div class="container">

    @if(Session::has('mensaje'))
<div class="alert alert-success alert-dismissible" role="alert">
    
        {{ Session::get('mensaje')}}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>

    @endif

<a href="{{url('usuarios/create')}}" class="btn btn-success btnSombras" >Crear nuevo usuario</a>
<br><br>

<table class="table table-light tablaUsuarios">
    <thead class="thead-light">
        <tr>
            <th>ID</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Edad</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>

        @foreach($usuarios as $usuario)
        <tr>
            <td>{{$usuario->id}}</td>
            <td><img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$usuario->Foto}}" alt="Img Usuario" width="100"></td>
            <td>{{$usuario->Nombre}}</td>
            <td>{{$usuario->Apellidos}}</td>
            <td>{{$usuario->Edad}}</td>
            <td>{{$usuario->Email}}</td>
            <td> 
                
            <a href="{{url('/usuarios/'.$usuario->id.'/edit')}}" class="btn btn-warning">
                Editar
            </a>
            

                <form action="{{url('/usuarios/'.$usuario->id)}}" method="post" class="d-inline">
                    @csrf

                    <!-- Metodo para cambiar de enviar una peticion en "Post" y la pase a "Delate" y pueda hacer el destroy o eliminado de usuario-->
                    {{ method_field('DELETE')}}

                    <input type="submit" onclick="return confirm('¿Deseas eliminar este usuario?')" value="Eliminar" class="btn btn-danger">

                    
                </form>

            </td>
        </tr>
        @endforeach

    </tbody>
</table>

    {!!$usuarios->links()!!}

</div>
@endsection