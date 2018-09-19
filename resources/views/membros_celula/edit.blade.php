@extends('master')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Atualizar membro</li>
  </ol>
</nav>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->has('message'))
<div class="alert alert-success">
  {{session()->get('message')}}
</div>
@endif


@if(session()->has('erro'))
<div class="alert alert-danger">
  {{session()->get('erro')}}
</div>
@endif
<form method="post" action="{{route('membros.update',$membros->id)}}" >
  @csrf   
  @method('put')
  <div class="form-group">
    <label for="cpf">CPF</label>
    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite o cpf" value="{{$membros->cpf}}">
  </div>
  <div class="form-group">
    <label for="email">E-mail</label>
    <input type="text" class="form-control" id="email" name="email" placeholder="Digite o e-mail" value="{{$membros->email}}">
  </div>
  <div class="form-group">
    <label for="nome">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome" value="{{$membros->nome}}">
  </div>
  <div class="form-group">
    <label for="endereco">Endereço</label>
    <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Digite o endereço" value="{{$membros->endereco}}">
  </div>
  <div class="form-group">
    @if(isset($celulas))
      <label for="lb_celula">Célula</label>
      <select class="form-control" id="celula_id" name="celula_id">
        <!--
        <option value=''>Selecione</option>
        -->
        @foreach($celulas as $celula)
        <option value="{{$celula->id}}" {{($celula->id == $membros->celula_id )? 'selected':''}}  >{{$celula->nome}}</option>
        @endforeach
      </select>
    @endif
  </div> 
  <!--
  <input type='hidden' id="ativa" name="ativa" value='1'> 
  -->
  <button type='submit' id='btn_salvar_membro_celula' class="btn btn-primary">Atualizar</button>
</form>
@endsection