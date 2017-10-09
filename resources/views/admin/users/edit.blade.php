@extends('layouts.master')

@section('content-header')
  <h1>
    Usuarios
    <small>Modificar perfil de usuario</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Usuarios</li>
  </ol>   
@endsection

@section('content')
	<div class="row">
		@if(isset($user))
			<div class="col-md-4">
	          <!-- Profile Image -->
	          <div class="box box-primary">
	            <div class="box-body box-profile">
	              <img class="profile-user-img img-responsive img-circle" src="{{ $user->profileImage() ? $user->profileImage()->path : 'http://placehold.it/150x150' }}" alt="User photo">
	              <h3 class="profile-username text-center">{{ $user->name }}</h3>
	              <p class="text-muted text-center">{{ $user->email }}</p>
	            
	            {!! Form::model($user, ['method' => 'POST', 'action' => ['UserController@update', $user->id], 'files' => true]) !!}
					{{ method_field('PUT') }}					
						<div class="form-group">
							{!! Form::label('photo_id', 'Fotografia:') !!}
							{!! Form::file('photo_id', null, ['class' => 'form-control']) !!}
						</div>
						{!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
					{!! Form::close() !!}
				</div>
	          </div>
	        </div>						
		@endif
	</div>
@endsection