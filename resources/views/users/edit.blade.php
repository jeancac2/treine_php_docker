@extends('layouts.app')
@section('title', "Editar Usuário {$user->name}")



@section('content')
<h1> Editar o Usuário: {{ $user->name }} </h1>
@include('includes.validations-form')


<form action="{{ route('users.update', $user->id) }}" method="post">
    
    @method('PUT')  <!-- Usamos _@method_ para gerar o seguinte: <input type="hidden" name="_method" value="PUT"> -->
    @include('users._partials.form')

</form>

@endsection