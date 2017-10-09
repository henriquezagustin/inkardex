@extends('layouts.master')

@section('content-header')
  <h1>
    Producto
    <small>Detalle</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Productos</li>
  </ol> 
@endsection

@section('content')
	<div class="row">
		@if(isset($product))
			<div class="col-md-4">
	          <!-- Profile Image -->
	          <div class="box box-primary">
	            <div class="box-body box-profile">
	              <img class="profile-user-img img-responsive img-circle" src="{{ $product->defaultImage() ? asset($product->defaultImage()->path) : 'http://placehold.it/150x150' }}" alt="Product photo">
	              <h3 class="profile-username text-center">{{ $product->name }}</h3>
	              <p class="text-muted text-center">{{ $product->sku }}</p>
	            </div>
	          </div>
	        </div>						
			<div class="col-md-8">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Detalle de producto</h3>
			              <ul class="list-group list-group-unbordered">
		              		<?php
		                		$a = $product->price;
		                		$b = $product->sell_price;
		                		$c = 0;
		                		if ($a > 0 && $a < $b) {
		                			$c = (1 - $a / $b) * 100;
		                		}	                		
		                	?>
		                	<li class="list-group-item">
			                  <b>Categoria</b> <a class="pull-right">{{ $product->category->name }}</a>
			                </li>
			                <li class="list-group-item">
			                  <b>Existencias</b> <a class="pull-right">{{ $product->quantity }}</a>
			                </li>
			                <li class="list-group-item">
			                  <b>Precio</b> <a class="pull-right">$ {{ $a }}</a>
			                </li>
			                <li class="list-group-item">
			                  <b>Precio de venta</b> <a class="pull-right">$ {{ $b }}</a>
			                </li>
			                <li class="list-group-item">
			                  	<b>Ganancia por venta</b> <a class="pull-right">% {{ $c }}</a>
			                </li>
			              </ul>
					</div>
				</div>
			</div> 
		@endif
	</div>
@endsection