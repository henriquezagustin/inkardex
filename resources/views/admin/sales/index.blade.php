@extends('layouts.master')

@section('content-header')
  <h1>
    Ventas
    <small>Listado de ventas procesadas</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Ventas</li>
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
          <a href="{{ route('sales.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Agregar</a>
        </div>
        <div class="box-body no-padding">
          <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Recibo No</th>
                <th>Cantidad</th>
                <th>Valor</th>
                <th>Empleado</th>
                <th>Fecha</th>
              </tr>  
            </thead>
            <tbody>
              @if($sales->count())
                <?php $i=1 ?>
                @foreach($sales as $sale)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $sale->receipt }}</td>                                
                    <td>{{ $sale->quantity }}</td>                              
                    <td>{{ $sale->amount }}</td>
                    <td>{{ isset($sale->user) ? $sale->user->name : "not associated" }}</td>
                    <td>{{ $sale->created_at }}</td>
{{--                     <td>
                      <a href="{{ route('products.show', ['id' => $sale->id], false) }}">Ver detalle&nbsp;</a>
                      <a href="{{ route('products.edit', ['id' => $sale->id], false) }}" class="btn btn-warning"><i class="fa fa-pencil"></i>Editar</a>
                    </td> --}}
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