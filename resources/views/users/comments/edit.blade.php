@extends('layouts.app')
@section('title', "Editar Comentário de {$user->name}")



@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2"> Editar Comentário do Usuário: {{ $user->name }} </h1>
@include('includes.validations-form')


<form action="{{ route('comments.update', $comment->id) }}" method="post">
    
    @method('PUT')  <!-- Usamos _@method_ para gerar o seguinte: <input type="hidden" name="_method" value="PUT"> -->
    @include('users.comments._partials.form')

</form>

@endsection