@extends('master')
@section('content')
	
	<div class="pb-4">
	    @if(isset($celula)) 
	    	<a class="btn btn-primary" href="{{route('criar_membro_na_celula', ['celula_id'=>$celula->id])}}" >Criar Membro para a célula: {{$celula->id}}</a>
	    @else
			<a class="btn btn-primary" href="{{route('membros.create')}}" >Criar Membro</a>
	    @endif

	</div>	

	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    @if(isset($celula)) 
	    <li class="breadcrumb-item active" aria-current="page">Listado de membros da célula: <strong> {{$celula->nome}}</strong></li>
	    @else
			<li class="breadcrumb-item active" aria-current="page">Listado de membros das células. </li>
	    @endif
	  </ol>
	</nav>
	@if(count($membros) > 0)
		<table class="table table-striped">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Nome</th>
		      <th scope="col">CPF</th>
		      @if(!isset($celula))
		      <th scope="col">Célula</th>
		      @endif
		      <th scope="col">Ação</th>
		    </tr>
		  </thead>
		  <tbody>
		    @php
		    $i=0;
		    @endphp
			@foreach ($membros as $membro)
				 <tr>
				   <th scope="row">{{++$i}}</th>
				   <td>{{ $membro->nome }}</td>
				   <td>{{ $membro->cpf}}</td>
				    @if(!isset($celula))
				   		<td>{{ $membro->celula->nome}}</td>
		   			    <td>
		   				   	<a href="{{route('membros.edit',$membro->id)}}" class="btn btn-primary">Editar</a>
		   			 		<form onsubmit="return confirm('Deseja realmente eliminar?')" class="d-inline-block"  method="post" action="{{route('membros.destroy',$membro->id)}}">
		   			 		 @csrf
		   			 		 @method('delete')
		   			 		 <button type="submit" id='btn_eliminar' name='btn_eliminar' class="btn btn-danger">Eliminar</button>
		   			 		</form>
		   		 	    </td>
				   @else
				    <td>
					   	<a href="{{route('membros.edit',$membro->id)}}" class="btn btn-primary">Editar</a>
				 		<form onsubmit="return confirm('Deseja realmente eliminar?')" class="d-inline-block"  method="post" action="{{route('membros.destroy',[$membro->id,'celula_id'=>$membro->celula_id ])}}">
				 		 @csrf
				 		 @method('delete')
				 		 <button type="submit" id='btn_eliminar' name='btn_eliminar' class="btn btn-danger">Eliminar</button>
				 		</form>
			 	    </td>
			 	    @endif
				 </tr>
			@endforeach
			<!--
		    @forelse ($membros as $membro)
		    	 <tr>
		    	   <th scope="row">{{++$i}}</th>
		    	   <td>{{ $membro->nome }}</td>
		    	   <td>{{ $membro->cpf}}</td>
		    	    @if(!isset($celula))
		    	   <td>{{ $membro->nome_celula}}</td>
		    	   @endif
		    	 </tr>
		    @empty
		        <div class="alert alert-primary">
		    	    @if(isset($celula)) 
		    	    Não existem membros na célula: <strong> {{$celula->nome}}</strong>
		    	    @else
		    			Não existem membros nas células.
		    	    @endif
		    	</div>
		    @endforelse
		    -->
		  </tbody>
		</table>
		<div class="mt-4">
		{{$membros->links()}}	
		</div>
	@else
	    <div class="alert alert-primary">
		    @if(isset($celula)) 
		    Não existem membros na célula: <strong> {{$celula->nome}}</strong>
		    @else
				Não existem membros nas células.
		    @endif
		</div>
	@endif
@endsection