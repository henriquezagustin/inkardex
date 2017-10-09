@extends('layouts.master')

@section('content-header')
  <h1>
    Fotografias
    {{-- <small>Creacion</small> --}}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Fotografias</li>
  </ol> 
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">Registro de fotografia</h3>
				</div>
				{!! Form::open(['method' => 'POST', 'action' => 'PhotoController@store', 'files' => true]) !!}
					<div class="box-body">
						<div class="form-group">
							{!! Form::label('photo_id', 'Photo:') !!}
							{!! Form::file('photo_id', null, ['class' => 'form-control']) !!}
						</div>						
					</div>
					<div class="box-footer">
						{!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
					</div>										
				{!! Form::close() !!}	
			</div>
		</div>
		<div class="col-md-4">
			@include('partials.errors')
		</div>	 
	</div>
@endsection