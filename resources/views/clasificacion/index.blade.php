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

        <h2>Listado de Clasificaciones</h2><br />

        @if( auth()->user()->role_id == 1)
        <button class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="#abrirmodal">
          <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Clasificación
        </button>
        @endif
      </div>
      <div class="card-body">
        <div class="form-group row">
          <div class="col-md-6">
            {!!Form::open(array('url'=>'clasificacion','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
            <div class="input-group">

              <input type="text" name="buscarTexto" class="form-control" placeholder="Buscar texto"
                value="{{ $buscarTexto }}">
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
            </div>
            {{ Form::close() }}
          </div>
        </div>
        <table class="table table-bordered table-striped table-sm">
          <thead>
            <tr class="bg-primary">

              <th>Clasificación</th>
              <th>Descripción</th>
              <th>Estado</th>

              @if( auth()->user()->role_id == 1)
              <th>Editar</th>
              <th>Cambiar Estado</th>
              @endif
            </tr>
          </thead>
          <tbody>

            @foreach($clasificaciones as $clas)

            <tr>

              <td>{{ $clas->nombre }}</td>
              <td>{{ $clas->descripcion }}</td>
              <td>
                @if($clas->condicion=="1")
                <button type="button" class="btn btn-success btn-md">
                  <i class="fa fa-check fa-2x"></i> Activo
                </button>
                @else
                <button type="button" class="btn btn-danger btn-md">
                  <i class="fa fa-check fa-2x"></i> Desactivado
                </button>
                @endif
              </td>

              @if( auth()->user()->role_id == 1)
              <td>
                <button type="button" class="btn btn-info btn-md" data-id_clasificacion="{{ $clas->id }}"
                  data-nombre="{{ $clas->nombre }}" data-descripcion="{{ $clas->descripcion }}" data-toggle="modal"
                  data-target="#abrirmodalEditar">
                  <i class="fa fa-edit fa-2x"></i> Editar
                </button> &nbsp;
              </td>
              <td>
                @if($clas->condicion)
                <button type="button" class="btn btn-danger btn-sm" data-id_clasificacion="{{ $clas->id }}"
                  data-toggle="modal" data-target="#cambiarEstado">
                  <i class="fa fa-times fa-2x"></i> Desactivar
                </button>
                @else
                <button type="button" class="btn btn-success btn-sm" data-id_clasificacion="{{ $clas->id }}"
                  data-toggle="modal" data-target="#cambiarEstado">
                  <i class="fa fa-lock fa-2x"></i> Activar
                </button>
                @endif
              </td>
              @endif
            </tr>

            @endforeach

          </tbody>
        </table>

        {{ $clasificaciones->render() }}

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
          <h4 class="modal-title">Agregar clasificación</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">


          <form action="{{ route('clasificacion.store') }}" method="post" class="form-horizontal">

            {{ csrf_field() }}

            @include('clasificacion.form')

          </form>
        </div>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!--Fin del modal-->


  <!--Inicio del modal actualizar-->
  <div class="modal fade" id="abrirmodalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-primary modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Actualizar clasificación</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">


          <form action="{{ route('clasificacion.update','test') }}" method="post" class="form-horizontal">

            {{ method_field('patch') }}
            {{ csrf_field() }}

            <input type="hidden" id="id_clasificacion" name="id_clasificacion" value="">

            @include('clasificacion.form')

          </form>
        </div>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!--Fin del modal-->


  <!--Inicio del modal Cambiar Estado-->
  <div class="modal fade" id="cambiarEstado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-primary modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Cambiar Estado de la Clasificación</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">


          <form action="{{ route('clasificacion.destroy','test') }}" method="post" class="form-horizontal">

            {{ method_field('delete') }}
            {{ csrf_field() }}

            <input type="hidden" id="id_clasificacion" name="id_clasificacion" value="">

            <p>Estas seguro de cambiar el estado?</p>


            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                  class="fa fa-times fa-2x"></i>Cerrar</button>
              <button type="submit" class="btn btn-success"><i class="fa fa-lock fa-2x"></i>Aceptar</button>
            </div>


          </form>
        </div>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!--Fin del modal-->




</main>

@endsection