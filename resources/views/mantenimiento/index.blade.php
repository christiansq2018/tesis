@extends('principal')
@section('contenido')
<main class="main">
  <!-- Breadcrumb -->
  <ol class="breadcrumb">
    <li class="breadcrumb-item active">
      <a href="/">
        SISTEMA DE INVENTARIO
      </a>
    </li>
  </ol>
  <div id="app" class="container-fluid">
    <div class="card">
      <div class="card-header d-flex align-items-center">
        <h2>
          Mantenimientos Agendados
        </h2>
        @if( auth()->user()->role_id == 1)
        <a href="{{ route('mantenimiento.create') }}" class="btn btn-primary btn-lg ml-auto">
          <i class="fa fa-plus mr-2"></i>
          Agendar Mantenimiento
        </a>
        @endif
      </div>
      <div class="card-body">
        @if( $mantenimientos->count() )
        <table class="table table-bordered table-striped" id="mantenimientos-table">
          <thead>
            <tr class="bg-primary">
              <th>
                Tipo
              </th>
              <th>
                Equipo
              </th>
              <th>
                Serie
              </th>
              <th>
                Proveedor
              </th>
              <th>
                Fecha Correspondiente
              </th>
              <th>
                Estado
              </th>
              @if( auth()->user()->role_id == 1)
              <th>
                Acciones
              </th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach( $mantenimientos as $mantenimiento )
            <tr class="bg-{{ $mantenimiento->due }}">
              <td>
                {{ $mantenimiento->tipo }}
              </td>
              <td>
                {{ $mantenimiento->equipo->nombre }}
              </td>
              <td>
                {{ $mantenimiento->equipo->activo_fijo }}
              </td>
              <td>
                {{ $mantenimiento->proveedor->nombre }}
              </td>
              <td>
                {{ $mantenimiento->fecha_vencimiento }}
              </td>
              <td>
                @if( $mantenimiento->due == 'success' )
                Aplicado el
                {{ $mantenimiento->ultima_aplicacion->fecha_aplicacion }}
                @else
                Pendiente
                @endif
              </td>
              @if( auth()->user()->role_id == 1)
              <td>
                @if( $mantenimiento->due != 'success')
                <btn-aplicar-servicio :service="{{ $mantenimiento->id }}" @servicesetup="openModal">
                </btn-aplicar-servicio>
                @else
                <a href="{{ route('aplicaciones.pdf', ['aplicacion'=>$mantenimiento->ultima_aplicacion]) }}"
                  class="btn btn-secondary bg-white">
                  <i class="fa fa-download"></i>
                </a>
                @endif
                <a href="#" class="btn btn-secondary bg-white">
                  <i class="fa fa-edit"></i>
                </a>
                <a href="#" class="btn btn-secondary bg-white"
                  onclick="if( !window.confirm('eliminar mantenimiento?') ){ return; } document.querySelector('#delete-mtto-{{ $mantenimiento->id }}').submit()">
                  <i class="fa fa-trash"></i>
                </a>
                <form id="delete-mtto-{{ $mantenimiento->id }}" method="POST"
                  action="{{ route('mantenimiento.destroy', ['mantenimiento'=>$mantenimiento->id]) }}">
                  @method('DELETE')
                  @csrf
                </form>
              </td>
              @endif
            </tr>
            @endforeach
          </tbody>
        </table>
        @else
        <div class="alert alert-info">
          No hay mantenimientos disponibles para mostrar
        </div>
        @endif
      </div>
    </div>
    <modal-apply-service :service="service" @serviceUpdated="service=null" />
  </div>
</main>
@endsection

@section('script')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</link>
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#mantenimientos-table').DataTable({
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
      }
    })
  })
</script>

<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script>
  Vue.component('btn-aplicar-servicio', {
    template: `
    <button
      class="btn btn-seconday bg-white"
      @click="setupService()"
      >
      Aplicar
    </button>
    `,
    props: ['service'],
    methods: {
      setupService() {
        this.$emit('servicesetup', this.service)
      }
    }
  })

  Vue.component('modal-apply-service', {
    props: ['service'],
    data() {
      return {
        disabledByHours: 0,
        disabledByMinutes: 0
      }
    },
    template: `
    <div class="modal" id="applyServiceModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h4 class="modal-title">Aplicar Mantenimiento</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <div class="modal-body">
            <form ref="applyServiceForm">
              <div class="form-group">
                <label>Tiempo Parado el Equipo por Mantenimiento</label>
                <div class="row">
                <div class="col">
                <label>Horas</label>
                <input type="number" class="form-control" v-model="disabledByHours"   min="0" max="23" placeholder="00" required/>
                </div>
                <div class="col">
                <label>Minutos</label>
                <input type="number" class="form-control" v-model="disabledByMinutes" min="0" max="59" placeholder="00" required/>
                </div>
                </div>
              </div>
              <div class="form-group">
              <button v-if="service" @click="applyService" class="btn btn-secondary">
                Aplicar
              </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    `,
    methods: {
      applyService() {
        if (!this.$refs.applyServiceForm.reportValidity()) {
          return
        }
        let data = {
          'disabled_hours':   this.disabledByHours,
          'disabled_minutes': this.disabledByMinutes,
          'mantenimiento_id': this.service
        }
        axios.post(`aplicaciones/store`, data).then(data => {
          this.$emit('serviceUpdated')
          $("#applyServiceModal").modal('hide')
        })
      }
    }
  })

  const app = new Vue({
    el: '#app',
    data() {
      return {
        service: null
      }
    },
    methods: {
      openModal(service) {
        if (!service) {
          return
        }
        this.service = service
        $("#applyServiceModal").modal()
      }
    }
  })
</script>
@endsection