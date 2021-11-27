@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{url('/usuarios/'.$usuario->id)}}" method="post" enctype="multipart/form-data"> 
    @csrf
    {{method_field('PATCH')}}
    
    @include('usuarios.form',['modo'=>'Editar']);

</form>
</div>
@endsection
