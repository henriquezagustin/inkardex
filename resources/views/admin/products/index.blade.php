@extends('layouts.master')

@section('content-header')
  <h1>
    Productos
    <small>Listado de productos</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Productos</li>
  </ol>   
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      @if (session('status'))
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Alert!</h4>
          {{ session('status') }}
        </div>  
      @endif
      <div class="box">              
        <div class="box-header">
          <a href="{{ route('products.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Agregar</a>
        </div>
        <div class="box-body no-padding">
          <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Sku</th>
                <th>Nombre</th>
                <th>Categoria</th>
                <th>Inventario</th>
                <th>Operacion</th>
              </tr>  
            </thead>
            <tbody>
              @if($products->count())
                <?php $i=1 ?>
                @foreach($products as $product)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $product->sku }}</td>                                
                    <td>{{ $product->name }}</td>                                
                    <td>{{ isset($product->category) ? $product->category->name : "not associated" }}</td>
                    <td>{{ $product->quantity }}</td>                                                              
                    <td>
                      <a href="{{ route('products.show', ['id' => $product->id]) }}">Ver detalle&nbsp;</a>
                      <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="btn btn-warning"><i class="fa fa-pencil"></i>Editar</a>
                    </td>
                  </tr>                                 
                @endforeach 
              @endif  
            </tbody>
          </table>
        </div>
      </div>     
    </div> 
  </div>
@endsection