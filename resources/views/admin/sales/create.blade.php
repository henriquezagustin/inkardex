@extends('layouts.master')

@section('content-header')
  <h1>
    Ventas
    {{-- <small>Creacion</small> --}}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Ventas</li>
  </ol> 
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">Orden de venta</h3>
				</div>
				<div class="box-body">
					{!! Form::open(['method' => 'POST', 'action' => 'SaleController@open']) !!}
					<div class="form-group col-xs-4">
						{!! Form::label('product_id', 'Producto:') !!}
						{!! Form::select('product_id', ['' => 'Choose an option'] + $products, null, ['class' => 'form-control']) !!}
					</div>								
					<div class="form-group col-xs-4">
						{!! Form::label('quantity', 'Cantidad:') !!}
						{!! Form::text('quantity', null, ['class' => 'form-control']) !!}
					</div>
					{!! Form::submit('Abrir orden', ['class' => 'btn btn-success col-xs-4 pull-right']) !!}
					{!! Form::close() !!}				
				</div>				
			</div>
		</div>
		<div class="col-md-4">
			@include('partials.errors')
		</div>	 
	</div>
@endsection