@extends('master')
@section('content')
	
	<div class="pb-4">
	<a class="btn btn-primary" href="{{route('celulas.create')}}" >Criar célula</a>
	</div>
		

	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item active" aria-current="page">Listado de células da IMEB</li>
	  </ol>
	</nav>

	<!--
	@php
	$exite_celula = 0;
	@endphp
	@foreach ($celulas as $celula)
		 $exite_celula = 1
		 <li>{{ $celula->nome }}</li>
	@endforeach	
	
	@if (count($celulas) == 0 )
		<div class="alert alert-primary">
		Não existem células.  
		</div>
	@endif
	-->
	@forelse ($celulas as $celula)
		 <div class="card mt-4">
		 		<div class="card-body">
		 		<h5 class="card-title">
			 		<a href="{{route('celulas.show',$celula->id)}}">{{ $celula->nome }}</a>
			 		<a href="{{route('celulas.edit',$celula->id)}}" class="btn btn-primary">Editar</a>
			 		<form onsubmit="return confirm('Deseja realmente eliminar?')" class="d-inline-block"  method="post" action="{{route('celulas.destroy',$celula->id)}}">
			 		 @csrf
			 		 @method('delete')
			 		 <button type="submit" id='btn_eliminar' name='btn_eliminar' class="btn btn-danger">Eliminar</button>
			 		</form>
			 		<a href="{{route('membros.show_da_celula', $celula->id)}}" class="btn btn-primary">Membros</a>
		 		</h5>
		 		</div>
		 </div>
	@empty
	    <div class="alert alert-primary">
		Não existem membros.  
		</div>
	@endforelse
	<div class="mt-4">
	{{$celulas->links()}}	
	</div>
@endsection