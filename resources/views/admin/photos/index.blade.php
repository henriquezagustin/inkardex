@extends('layouts.master')

@section('content-header')
  <h1>
    Fotografias
    <small>Listado de fotografias</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Fotografias</li>
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
        </div>
        <div class="box-body no-padding">
          <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Foto</th>                
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Operacion</th>
              </tr>  
            </thead>
            <tbody>
              @if($photos->count())
                <?php $i=1 ?>
                @foreach($photos as $photo)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td><img src="{{ $photo->path ? asset($photo->path) : 'http://placehold.it/50x50' }}" class="img-circle" alt="{{ $photo->name }}" height="50"></td>
                    <td>{{ $photo->name }}</td>                                                               
                    <td>{{ $photo->imageable_type }}</td>                                                               
                    <td>
                      {!! Form::open(['method' => 'DELETE', 'action' => ['PhotoController@destroy', $photo->id]]) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}             
                      {!! Form::close() !!}
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