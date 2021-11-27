@extends('layouts.app')

@section('content')
<div class="container">
<form action= "{{url('/usuarios')}}" method="POST" enctype="multipart/form-data">

    <!-- El @csrf es un token que facilita la protección de su aplicación contra ataques de falsificación de solicitudes entre sitios  https://laravel.com/docs/5.8/csrf-->
    @csrf
    @include('usuarios.form',['modo'=>'Crear']);
</form>
</div>
@endsection