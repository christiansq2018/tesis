@extends('principal')
@section('styles')
<style>
  .vs__dropdown-toggle {
    border-radius: 0px;
    padding: 4px 10px;
  }
</style>
@endsection
@section('contenido')
<main class="main" id="app">
  <!-- Breadcrumb -->
  <ol class="breadcrumb">
    <li class="breadcrumb-item active"><a href="/">BACKEND - AGENDAR MANTENIMIENTO</a></li>
  </ol>
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h2>
          Agendar Mantenimiento
        </h2>
      </div>
      <div class="card-body">
        <form action="{{ route('mantenimiento.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="">Equipo</label>
            <!-- <select name="equipo_id" id="" class="form-control" name="equipo_id" required>
              @foreach($equipos as $equipo)
              <option value="{{ $equipo->id }}">
                {{ $equipo->nombre }} - {{ $equipo->activo_fijo }}
              </option>
              @endforeach
            </select> -->
            <v-select
              v-model="equipo"
              :autocomplete="'true'"
              :options="equipos"
              :get-option-label="getOptionLabel"
              :placeholder="'Seleccionar equipo'">
            </v-select>
          </div>
          <div class="form-group">
            <label for="">Proveedor</label>
            <select name="proveedor_id" class="form-control" name="proveedor_id" required>
              @foreach($proveedores as $proveedor)
              <option value="{{ $proveedor->id }}">
                {{ $proveedor->nombre }}
              </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="" style="display: block;">
              Tipo de Mantenimiento
            </label>
            <div class="form-check form-check-inline">
              <input class="form-check-input ml-0" type="radio" name="tipo" id="inlineRadio1" value="preventivo" required>
              <label class="form-check-label" for="inlineRadio1">Preventivo</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input ml-0" type="radio" name="tipo" id="inlineRadio2" value="correctivo">
              <label class="form-check-label" for="inlineRadio2">Correctivo</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input ml-0" type="radio" name="tipo" id="inlineRadio3" value="metrologia">
              <label class="form-check-label" for="inlineRadio3">Metrología</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input ml-0" type="radio" name="tipo" id="inlineRadio4" value="calificacion">
              <label class="form-check-label" for="inlineRadio4">Calificacion</label>
            </div>
          </div>
          <div class="row">
            <div class="form-group col">
              <label for="fecha_vencimiento">
                Mes de Proxima de Revisión
              </label>
              <select name="mes_vencimiento" id="" class="form-control">
                <?php $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] ?>
                @foreach(range(1,12) as $mes)
                <option value="{{ $mes }}">
                  {{ $meses[ $mes - 1 ] }}
                </option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-3">
              <label for="#">Frecuencia de Mantenimiento</label>
              <select name="rate" id="" class="form-control">
                @foreach(range(1,12) as $mes)
                <option value="{{ $mes }}">
                  {{ $mes }} Meses
                </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">
              Enviar
            </button>
          </div>
          <input type="hidden" v-model="equipo.id" name="equipo_id">
        </form>
      </div>
    </div>
  </div>
  <!--Fin del modal-->
</main>
@endsection

@section('script')
<script>
  const app = new Vue({
    el: '#app',
    data() {
      return {
        equipo: {},
        equipos: {!!json_encode($equipos) !!}
      }
    },
    methods: {
      getOptionLabel(option) {
        return option.nombre + ' - ' + option.activo_fijo
      }
    },
    mounted(){
      this.equipo = this.equipos[0]
    }
  })
</script>
@endsection