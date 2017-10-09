@extends('layouts.master')

@section('content-header')
  <h1>
    Productos
    <small>Modificar</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Productos</li>
  </ol> 
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">Modificacion del producto</h3>
				</div>
				{!! Form::model($product, ['method' => 'POST', 'action' => ['ProductController@update', $product->id], 'files' => true]) !!}
					{{ method_field('PUT') }}
					<div class="box-body">
						<div class="form-group">
							{!! Form::label('category_id', 'Categoria:') !!}
							{!! Form::select('category_id', ['' => 'Choose an option'] + $categories, null, ['class' => 'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('name', 'Nombre:') !!}
							{!! Form::text('name', $product->name, ['class' => 'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('quantity', 'Cantidad:') !!}
							{!! Form::text('quantity', null, ['class' => 'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('price', 'Precio:') !!}
							{!! Form::text('price', null, ['class' => 'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('sell_price', 'Precio de venta:') !!}
							{!! Form::text('sell_price', null, ['class' => 'form-control']) !!}
						</div>
						<div class="form-group">
							{!! Form::label('photo_id', 'Fotografia:') !!}
							{!! Form::file('photo_id', null, ['class' => 'form-control']) !!}
						</div>	
					</div>
					<div class="box-footer">
						{!! Form::submit('Guardar', ['class' => 'btn btn-success col-sm-2']) !!}
				{!! Form::close() !!}
				{!! Form::open(['route' => ['products.destroy', $product->id]]) !!}
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