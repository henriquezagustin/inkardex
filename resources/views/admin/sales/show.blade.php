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
				@if(isset($sale))
				<div class="box-header with-border">
					<h3 class="box-title">Detalle de la orden</h3>
				</div>
				<div class="box-body">					
					{!! Form::open(['method' => 'POST', 'action' => ['SaleController@add', $sale->id]]) !!}
					<div class="form-group col-xs-4">
						{!! Form::label('product_id', 'Producto:') !!}
						{!! Form::select('product_id', ['' => 'Choose an option'] + $products, null, ['class' => 'form-control']) !!}
					</div>								
					<div class="form-group col-xs-4">
						{!! Form::label('quantity', 'Cantidad:') !!}
						{!! Form::text('quantity', null, ['class' => 'form-control']) !!}
					</div>
					{!! Form::submit('Agregar item', ['class' => 'btn btn-success col-xs-4 pull-right']) !!}	
					{!! Form::close() !!}							
				</div>				
				<div class="box-footer">							
					{!! Form::open(['method' => 'POST', 'action' => 'SaleController@store']) !!}
						<input type="hidden" name="id" value="{{ $sale->id }}">		
						{!! Form::submit('Procesar orden', ['class' => 'btn btn-info col-sm-4 pull-right']) !!} 
					{!! Form::close() !!}				
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th style="width: 10px">#</th>
								<th>Producto</th>
								<th>Nombre</th>
								<th>Cantidad</th>
								<th>Valor</th>
							</tr>  
						</thead>
						<tbody>							
							<?php $i=1 ?>
							@foreach($sale->detail as $item)
								<tr>
									<td>{{ $i++ }}</td>
									<td>{{ $item->product->sku }}</td>                                
									<td>{{ $item->product->name }}</td>                                
									<td>{{ $item->quantity }}</td>                              
									<td>{{ $item->amount }}</td>
									<td>
										{!! Form::open(['route' => ['sales.update', $sale->id]]) !!}
											{{ method_field('PUT') }}
											<input type="hidden" name="item_id" value="{{ $item->id}}">
											{!! Form::submit('Quitar', ['class' => 'btn btn-danger']) !!}    
										{!! Form::close() !!}
									</td>
								</tr>                                 
							@endforeach							  
						</tbody>
					</table>	
				</div>
				@endif	
			</div>
		</div>
		<div class="col-md-4">
			@include('partials.errors')
		</div>	 
	</div>
@endsection