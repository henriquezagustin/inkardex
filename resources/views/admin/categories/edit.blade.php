@extends('layouts.master')

@section('content-header')
  <h1>
    Categorias
    {{-- <small>Creacion</small> --}}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Categorias</li>
  </ol> 
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">Modificacion de categoria</h3>
				</div>
				{!! Form::model($category, ['route' => ['categories.update', $category->id]]) !!}
					{{ method_field('PUT') }}
					<div class="box-body">
						<div class="form-group">
							{!! Form::label('name', 'Nombre:') !!}
							{!! Form::text('name', $category->name, ['class' => 'form-control']) !!}
						</div>						
					</div>
					<div class="box-footer">
						{!! Form::submit('Modificar', ['class' => 'btn btn-success col-sm-2']) !!}
				{!! Form::close() !!}
				{!! Form::open(['route' => ['categories.destroy', $category->id]]) !!}
					{{ method_field('DELETE') }}
					{!! Form::submit('Borrar', ['class' => 'btn btn-danger col-sm-2 pull-right']) !!}    
				{!! Form::close() !!}
					</div>
			</div>
		</div>
		<div class="col-md-4">
			@include('partials.errors')
		</div>	 
	</div>
@endsection