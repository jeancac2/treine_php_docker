@extends('layouts.app')

@section('title', "Novo Comentário do Usuário {$user->name}")



@section('content')
<h1 class="text-2xl font-semibold leading-tigh py-2"> 
    Novo Comentário para o Usuário {{ $user->name }} 
</h1>

@include('includes.validations-form')

<form action="{{ route('comments.store', $user->id) }}" method="post">
    @csrf <!-- token contra ataque csrf -->    
    @include('users.comments._partials.form')

</form>

@endsection