@extends('layouts.master')

@section('content-header')
  <h1>
    Categorias
    <small>Listado de registros</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Categorias</li>
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
          <a href="{{ route('categories.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Agregar</a>
        </div>
        <div class="box-body no-padding">
          <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Nombre</th>
                <th>Operacion</th>
              </tr>  
            </thead>
            <tbody>
              @if($categories->count())
                <?php $i=1 ?>
                @foreach($categories as $category)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $category->name }}</td>                                
                    <td>
                      <a href="{{ route('categories.edit', ['id' => $category->id]) }}" class="btn btn-warning"><i class="fa fa-pencil"></i>&nbsp;Editar</a>
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