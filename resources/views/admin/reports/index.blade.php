@extends('layouts.master')

@section('content-header')
  <h1>
    Reporte
    <small>Resumen de ventas</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Reportes</li>
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
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">2do semestre 2017</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="chart">
            <canvas id="myChart" width="400" height="150"></canvas>
          </div>
        </div>
        <div class="box-body">
          <?php
              $a = $data->profit;
              $b = $data->amount;
              $c = 0;
              $c = ($a/$b)*100;
           ?>
            <div class="col-md-6">
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Ventas totales</b> <a class="pull-right">$ {{ isset($data) ? number_format($data->amount, 2, '.', ',') : 0 }}</a>
                </li>
                <li class="list-group-item">
                  <b>Numero de ventas</b> <a class="pull-right">{{ isset($data) ? number_format($data->quantity, 2, '.', ',') : 0 }}</a>
                </li>
                <li class="list-group-item">
                  <b>Venta promedio</b> <a class="pull-right">$ {{ isset($data) ? number_format($data->average, 2, '.', ',') : 0 }}</a>
                </li>
              </ul> 
            </div>
            <div class="col-md-6">
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Ganancia</b> <a class="pull-right">$ {{ isset($data) ? number_format($data->profit, 2, '.', ',') : 0 }}</a>
                </li>
                <li class="list-group-item">
                  <b>Margen de ganancia promedio</b> <a class="pull-right">% {{ $c }}</a>
                </li>
              </ul>
            </div>     
        </div>
      </div> 
    </div> 
  </div>
@endsection

@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script>
  <script type="text/javascript">

    $(document).ready(function() {

      var months = ["Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
      var sales = {!! json_encode($sales) !!};
      var profits = {!! json_encode($profits) !!};
      var ctx = document.getElementById('myChart').getContext('2d');
      var chart = new Chart(ctx, {
          // The type of chart we want to create
          type: 'bar',
          // The data for our dataset
          data: {
              labels: months,
              datasets: [
                {
                  label: "Ventas",
                  backgroundColor: "#aaadff",
                  fill: true,
                  // data: [8, 10, 5, 2, 20, 30],
                  data: sales,
                },
                {
                  label: "Ganancias",
                  backgroundColor: "#407aaa",
                  fill: true,
                  // data: [5, 4, 7, 2, 20, 30],
                  data: profits,
                }
              ]
          },
          // Configuration options go here
          options: {}
      });
    });
  </script>
@endsection