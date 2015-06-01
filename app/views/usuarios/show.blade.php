@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<h2 class="titul">Usuarios</h2>
		<div class="row">
			@if(Session::has('mensaje'))
				<div class="alert alert-info">{{ Session::get('mensaje') }}</div>
			@endif
			@foreach($ShowUser as $value)
				@if(Auth::user()->id!=$value->id)
				<div class="row">
					<div class="col-md-3">
						<img class="img-responsive" src="{{ asset( 'img/user.png') }}" alt="">
					</div>
					<div class="col-md-9">									
						<h2 class="titul">{{$value->nombre}}</h2>										
						<p>{{$value->username}}</p>						
						<a href="{{ URL::to('/administrador/usuarios/del/'.$value->id) }}">
							<h2 class="btn btn-danger">Eliminar</h2>
						</a>										
					</div>									
				</div>
				<br>
				@endif
				@if(count($ShowUser)==1)
					<h3 class="titul">No hay usuarios para mostrar</h3>
				@endif
			@endforeach
			{{$ShowUser->links()}}
		</div>
	</div>
@stop