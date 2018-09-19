@extends('master')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Criar uma Célula.</li>
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

<form method="post" action="{{route('celulas.store')}}" >
  @csrf 	
  <div class="form-group">
    <label for="codigo">Código</label>
    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Digite o código">
  </div>
  <div class="form-group">
    <label for="nome">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome">
  </div>
  <div class="form-group">
    <label for="endereco">Endereço</label>
    <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Digite o endereço">
  </div>
  <!--
  <div class="form-group">
    <label for="nome">Nome</label>
    <input type="text" class="form-control" id="txt_nome" placeholder="Digite o código">
  </div>
  -->
  <input type='hidden' id="ativa" name="ativa" value='1'> 
  <button type='submit' id='btn_salvar_celula' class="btn btn-primary">Salvar</button>
</form>
@endsection