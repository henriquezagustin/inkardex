@extends('layouts.master')

@section('content-header')
  <h1>
    Usuarios
    <small>Listado de usuarios</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Usuarios</li>
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
                <th>Correo</th>
                <th>Operacion</th>
              </tr>  
            </thead>
            <tbody>
              @if($users->count())
                <?php $i=1 ?>
                @foreach($users as $user)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td><img src="{{ $user->profileImage() ? asset($user->profileImage()->path) : 'http://placehold.it/50x50' }}" class="img-circle" alt="{{ $user->name }}" height="50"></td>
                    <td>{{ $user->name }}</td>                                                               
                    <td>{{ $user->email }}</td>                                                               
                    <td>
                      <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-warning"><i class="fa fa-pencil"></i>Editar</a>
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