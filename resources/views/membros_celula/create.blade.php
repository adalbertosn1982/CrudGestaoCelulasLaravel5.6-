@extends('master')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    @if(isset($celula))
      <li class="breadcrumb-item active" aria-current="page">Criar membro para a Célula: {{$celula->nome}} </li>
    @else
      <li class="breadcrumb-item active" aria-current="page">Criar membro.</li>
    @endif
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

<form method="post" action="{{route('membros.store')}}" >
  @csrf 	
  <div class="form-group">
    <label for="cpf">CPF</label>
    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite o cpf">
  </div>
  <div class="form-group">
    <label for="email">E-mail</label>
    <input type="text" class="form-control" id="email" name="email" placeholder="Digite o e-mail">
  </div>
  <div class="form-group">
    <label for="nome">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome">
  </div>
  <div class="form-group">
    <label for="endereco">Endereço</label>
    <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Digite o endereço">
  </div>
  <div class="form-group">
    @if(isset($celula))
      <label for="lb_celula">Célula</label>
      <select class="form-control" id="celula_id" name="celula_id" readonly>
        <option value="{{$celula->id}}" >{{$celula->nome}}</option>
      </select>
    @else
      <label for="lb_celula">Célula</label>
      <select class="form-control" id="celula_id" name="celula_id">
        <option value=''>Selecione</option>
        @foreach($celulas as $celula)
        <option value="{{$celula->id}}" >{{$celula->nome}}</option>
        @endforeach
      </select>
    @endif

  </div>
  <!--
  <input type='hidden' id="ativa" name="ativa" value='1'> 
  -->
  <button type='submit' id='btn_salvar_membro_celula' class="btn btn-primary">Salvar</button>
</form>
@endsection