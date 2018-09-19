@extends('master')
@section('content')
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item active" aria-current="page">Dados do Membro</li>
	  </ol>
	</nav>
	@if($celula->nome)		
		 <div class="card mt-4">
		   <div class="card-header">
		     Código:{{$celula->id }}	
		   </div>
		   
		   <div class="card-body">
		     <h5 class="card-title">Nome : {{ $celula->nome }}</h5>
		     <p class="card-text">Endereço: {{ $celula->endereco }}</p>
		     <a href="{{route('celulas.edit',$celula->id)}}" class="btn btn-primary">Editar</a>
		     <form class="d-inline-block" onsubmit="return confirm('Deseja realmente eliminar?')" method="post" action="{{route('celulas.destroy',$celula->id)}}">
		      @csrf
		      @method('delete')
		      <button type="submit" id='btn_eliminar' name='btn_eliminar' class="btn btn-danger">Eliminar</button>
		     </form>
		   </div>
		   
		 </div>
	@else
	    <div class="alert alert-primary">
		Não existem dados da célula.  
		</div>		
	@endif

@endsection