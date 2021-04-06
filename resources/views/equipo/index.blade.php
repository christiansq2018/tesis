@extends('principal')
@section('contenido')
<main class="main">
  <!-- Breadcrumb -->
  <ol class="breadcrumb">
    <li class="breadcrumb-item active"><a href="/">SISTEMA DE INVENTARIO</a></li>
  </ol>
  <div class="container-fluid">
    <!-- Ejemplo de tabla Listado -->
    <div class="card">
      <div class="card-header">
        <h2>
          Listado de Equipos
        </h2>
        @if( auth()->user()->role_id == 1)
        <button data-toggle="modal" data-target="#abrirmodal" type="button" class="btn btn-primary btn-lg">
          <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Equipo
        </button>
        @endif

        <a href="{{ url('listarEquipoPdf' )}}" target="_blank">
          <button type="button" class="btn btn-success btn-lg">
            <i class="fa fa-file fa-2x"></i>
            Reporte PDF
          </button>
        </a>
      </div>
      <div class="card-body">
        <div class="form-group row">
          <div class="col-md-6">
            {!!Form::open(array('url'=>'equipo','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
            <div class="input-group">
              <input type="text" name="buscarTexto" class="form-control" placeholder="Buscar texto"
                value="{{$buscarTexto}}">
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
            </div>
            {{Form::close()}}
          </div>
        </div>
        <table class="table table-bordered table-striped table-sm">
          <thead>
            <tr class="bg-primary">
              <th>Imagen</th>
              <th>Categoria</th>
              <th>Equipo</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Codigo</th>
              <th>Ubicacion</th>
              <th>Piso</th>
              <!-- <th>Estado</th> -->
              @if( auth()->user()->role_id == 1)
              <th>Editar</th>
              <th>Cambiar Estado</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach($equipos as $prod)
            <tr>
              <td>
                @if( $prod->imagen )
                <img src="{{asset('storage/img/equipo/' . $prod->imagen)}}" id="imagen1" alt="{{$prod->nombre}}"
                  class="img-responsive" width="100px" height="100px">
                @else
                <i class="fa fa-photo"></i>
                @endif
              </td>
              <td>
                {{$prod->clasificacion->nombre}}
              </td>
              <td>
                {{$prod->nombre}}
              </td>
              <td>
                {{$prod->marca}}
              </td>
              <td>
                {{$prod->modelo}}
              </td>
              <td>
                {{$prod->activo_fijo}}
              </td>
              <td style="font-size: 12px;">
                {{$prod->ubicacion}}
              </td>
              <td>
                {{$prod->piso}}
              </td>
              <!-- <td>
                @if($prod->condicion=="1")
                <button type="button" class="btn btn-success btn-md">
                  <i class="fa fa-check fa-2x"></i> Activo
                </button>
                @else
                <button type="button" class="btn btn-danger btn-md">
                  <i class="fa fa-check fa-2x"></i> Desactivado
                </button>
                @endif
              </td> -->
              @if( auth()->user()->role_id == 1)
              <td>
                <button data-id_equipo="{{$prod->id}}" data-id_clasificacion="{{$prod->clasificacion_id}}"
                  data-activo_fijo="{{$prod->activo_fijo}}" data-nombre="{{$prod->nombre}}"
                  data-marca="{{$prod->marca}}" data-modelo="{{$prod->modelo}}" data-ubicacion="{{$prod->ubicacion}}"
                  data-piso="{{$prod->piso}}" data-motivo_baja="{{$prod->motivo_baja}}"
                  data-fecha_entrega_servicio="{{$prod->fecha_entrega_servicio}}"
                  data-fecha_baja="{{$prod->fecha_baja}}" data-serie="{{$prod->serie}}" data-toggle="modal"
                  data-target="#abrirmodalEditar" type="button" class="btn btn-info btn-md">
                  <i class="fa fa-edit fa-2x"></i>
                  Editar
                </button>
              </td>
              <td>
                @if($prod->condicion)
                <button type="button" class="btn btn-danger btn-sm" data-id_equipo="{{$prod->id}}" data-toggle="modal"
                  data-target="#cambiarEstado">
                  <i class="fa fa-times fa-2x"></i>
                  Desactivar
                </button>
                @else
                <button type="button" class="btn btn-success btn-sm" data-id_equipo="{{$prod->id}}" data-toggle="modal"
                  data-target="#cambiarEstado">
                  <i class="fa fa-lock fa-2x"></i>
                  Activar
                </button>
                @endif
              </td>
              @endif
            </tr>
            @endforeach
          </tbody>
        </table>

        {{$equipos->render()}}

      </div>
    </div>
    <!-- Fin ejemplo de tabla Listado -->
  </div>

  <!--Inicio del modal agregar-->
  <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-primary modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Agregar equipo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('equipo.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
            {{csrf_field()}}
            @include('equipo.form')
          </form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
  <!--Fin del modal-->



  <!--Inicio del modal actualizar-->
  <div class="modal fade" id="abrirmodalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-primary modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Actualizar equipo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">
          <form action="{{ route('equipo.update','test') }}" method="post" class="form-horizontal"
            enctype="multipart/form-data">
            {{method_field('patch')}}
            {{csrf_field()}}
            <input type="hidden" id="id_equipo" name="id_equipo" value="">
            @include('equipo.form')
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- MODAL ESTADO EQUIPO -->
  <div class="modal fade" id="cambiarEstado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-primary modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Cambiar Estado del Equipo</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">
          <form id="form-delete-equipo" action="{{route('equipo.destroy','test')}}" method="post"
            class="form-horizontal">
            {{method_field('delete')}}
            {{csrf_field()}}
            <input type="hidden" id="id_equipo" name="id_equipo" value="">
            <p>
              Estas seguro de cambiar el estado?
            </p>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                  class="fa fa-times fa-2x"></i>Cerrar</button>
              <button type="submit" class="btn btn-success">
                <i class="fa fa-lock fa-2x"></i>
                Aceptar
              </button>
            </div>
          </form>
        </div>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</main>
@endsection