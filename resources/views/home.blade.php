@extends('principal')
@section('contenido')
<main class="main">
  <!-- Breadcrumb -->
  <ol class="breadcrumb">
    <li class="breadcrumb-item active">
      <a href="/">SISTEMA DE INVENTARIO</a>
    </li>
  </ol>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4">
        <div class="card">
          <div class="card-header text-center">
            <h4>
              Mantenimientos Completados
            </h4>
          </div>
          <div class="card-body">
            <canvas id="chart_mtto_mes" width="100%">
            </canvas>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card">
          <div class="card-header text-center">
            <h4>
              Tiempo Promedio de Respuesta
            </h4>
          </div>
          <div class="card-body text-center">
            <canvas id="chart_avg_respuesta" width="100%">
            </canvas>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card">
          <div class="card-header text-center">
            <h4>
              Promedio Horas Inhabilidad por Mantenimiento
            </h4>
          </div>
          <div class="card-body text-center">
            <canvas id="chart_avg_disabled" width="100%">
            </canvas>
          </div>
        </div>
      </div>
    </div>

    @push('scripts')
    <script src="{{asset('js/Chart.min.js')}}"></script>
    <script>
      $(function() {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //--------------
        //- AREA CHART -
        //--------------
      })
    </script>
    @endpush
  </div>
</main>
@endsection

@section('script')
<script>
  var elChartMttoMes = document.getElementById('chart_mtto_mes').getContext('2d');
  var elAvgRespuesta = document.getElementById('chart_avg_respuesta').getContext('2d');
  var elChartAvgDisabled = document.getElementById('chart_avg_disabled').getContext('2d');

  var chartMttoMes      = new Chart(elChartMttoMes, {!! json_encode($chart_mantenimientos) !!})
  var chartAvgRespuesta = new Chart(elAvgRespuesta, {!! json_encode($chart_promedio_respuesta) !!})
  var chartAvgDisabled  = new Chart(elChartAvgDisabled, {!! json_encode($chart_promedio_disabled) !!})

</script>
@endsection