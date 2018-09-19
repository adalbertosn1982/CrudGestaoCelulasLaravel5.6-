<!DOCTYPE html>
<html lang="pt">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Células da IMEB</title>
	<link rel="stylesheet" href="/css/bootstrap.css">
</head>
<body>
<div class="row">
	<div class="col-12">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
	      <!--
	      <li class="nav-item active">
	        <a class="nav-link" href="{{route('home')}}">HOME </a>
	      </li>
	      -->
	      <li class="nav-item{{ (Request::is('celulas') || Request::is('celulas/*') ) ? ' active' : '' }}">
	        <a class="nav-link" href="{{route('celulas.index')}}">Celulas<span class="sr-only">(current)</span></a>
	      </li>
	      <!--
	      <li class="nav-item">
	        <a class="nav-link" href="{{route('celulas.create')}}">Membros</a>
	      </li>
	      -->
	      <li class="nav-item{{ (Request::is('membros') || Request::is('membros/*') ) ? ' active' : '' }}">
	        <a class="nav-link" href="{{route('membros.index')}}">Membros</a>
	      </li>
	    </ul>

	  </div>
	</nav>
	</div>
	<div style="position: absolute; right: 0;">	
		@auth
		<form onsubmit="return confirm('Deseja realmente eliminar?')" class="d-inline-block"  method="post" action="{{route('logout')}}">
		 @csrf
		 <button type="submit" id='btn_sair' name='btn_sair' class="btn btn-info">{{auth()->user()->name}} | Sair</button>
		</form>
		@else
		<a href="{{route('login')}}" class="btn btn-info">Entrar</a>
		@endauth
	</div>
</div>

<div class="container mt-5">
	@yield('content')
</div>
<div class="bg-dark text-white p-4 mt-5 text-center">
	Todos os direitos reservados {{date('Y')}}.
</div>	

</body>
</html>