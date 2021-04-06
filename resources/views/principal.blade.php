<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Sistema Compras-Ventas con Laravel y Vue Js- webtraining-it.com">
  <meta name="keyword" content="Sistema Compras-Ventas con Laravel y Vue Js">
  <title>Proyecto</title>
  <!-- Icons -->
  <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{asset('css/simple-line-icons.min.css')}}" rel="stylesheet">
  <!-- Main styles for this application -->
  <link href="{{asset('css/style.css')}}" rel="stylesheet">
  <script src="{{asset('js/app.js')}}"></script>
  @yield('styles')
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js">-->
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
  <header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!--PONER LOGO-->
    <!--<a class="navbar-brand" href="#"></a>-->
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav navbar-nav d-md-down-none">
      <li class="nav-item px-3">
        <a class="nav-link" href="#">Dashboard</a>
      </li>
    </ul>
    <ul class="nav navbar-nav ml-auto">
      @include('plantilla.notifications')
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
          aria-expanded="false">
          @if( auth()->user()->imagen )
          <img src="{{ asset('storage/img/usuario/' . Auth::user()->imagen) }}" class="img-avatar" class="img-avatar"
            alt="{{ auth()->user()->nombre }}">
          @else
          <img src="{{ asset('img/avatars/7.jpg') }}" class="img-avatar" class="img-avatar"
            alt="{{ auth()->user()->nombre }}">
          @endif
          <span class="d-md-down-none">{{Auth::user()->usuario}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <div class="dropdown-header text-center">
            <strong>Cuenta</strong>
          </div>
          <a class="dropdown-item" href="{{route('logout')}}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-lock"></i> Cerrar sesión</a>

          <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </div>
      </li>
    </ul>
  </header>

  <div class="app-body">

    @if(Auth::check())
    @if (Auth::user()->role_id == 1)
    @include('plantilla.sidebaradministrador')
    @elseif (Auth::user()->role_id == 2)
    @include('plantilla.sidebarcoordinador')
    @endif
    @endif

    <!-- Contenido Principal -->

    @yield('contenido')

    <!-- /Fin del contenido principal -->
  </div>

  <footer class="app-footer">
    <span><a href="http://www.usc.edu.co/">www.usc.edu.co</a> &copy; 2021</span>
    <span class="ml-auto">Desarrollado por <a href="http://www.usc.edu.co/">www.usc.edu.co</a></span>
  </footer>

  <!-- Bootstrap and necessary plugins -->
  <script src="{{asset('js/jquery.min.js')}}"></script>
  @stack('scripts')
  <script src="{{asset('js/popper.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <script src="{{asset('js/pace.min.js')}}"></script>
  <!-- Plugins and scripts required by all views -->
  <script src="{{asset('js/Chart.min.js')}}"></script>
  <!-- GenesisUI main scripts -->
  <script src="{{asset('js/template.js')}}"></script>
  <script src="{{asset('js/sweetalert2.all.min.js')}}"></script>

  <script>
    /*EDITAR CATEGORIA EN VENTANA MODAL*/
    $('#abrirmodalEditar').on('show.bs.modal', function(event) {

      //console.log('modal abierto');

      var button = $(event.relatedTarget)
      var nombre_modal_editar = button.data('nombre')
      var descripcion_modal_editar = button.data('descripcion')
      var id_categoria = button.data('id_categoria')
      var modal = $(this)
      // modal.find('.modal-title').text('New message to ' + recipient)
      modal.find('.modal-body #nombre').val(nombre_modal_editar);
      modal.find('.modal-body #descripcion').val(descripcion_modal_editar);
      modal.find('.modal-body #id_categoria').val(id_categoria);
    })


    /******************************************************/
    /*INICIO ventana modal para cambiar estado de Categoria*/

    $('#cambiarEstado').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var id_categoria = button.data('id_categoria')
      var modal = $(this)
      modal.find('.modal-body #id_categoria').val(id_categoria);
    })

    /*FIN ventana modal para cambiar estado de la categoria*/

    /*EDITAR PRODUCTO EN VENTANA MODAL*/
    $('#abrirmodalEditar').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var modal                  = $(this)

      var nombre                 = button.data('nombre')
      let serie                  = button.data('serie')
      let activo_fijo            = button.data('activo_fijo')
      let marca                  = button.data('marca')
      let modelo                 = button.data('modelo')
      let ubicacion              = button.data('ubicacion')
      let piso                   = button.data('piso')
      let motivo_baja            = button.data('motivo_baja')
      let fecha_baja             = button.data('fecha_baja')
      let fecha_entrega_servicio = button.data('fecha_entrega_servicio')
      var id_categoria           = button.data('id_categoria')
      var id_equipo              = button.data('id_equipo')
      
      modal.find('.modal-body #serie').val(serie);
      modal.find('.modal-body #activo_fijo').val(activo_fijo);
      modal.find('.modal-body #marca').val(marca);
      modal.find('.modal-body #modelo').val(modelo);
      modal.find('.modal-body #ubicacion').val(ubicacion);
      modal.find('.modal-body #piso').val(piso);
      modal.find('.modal-body #motivo_baja').val(motivo_baja);
      modal.find('.modal-body #fecha_baja').val(fecha_baja);
      modal.find('.modal-body #fecha_entrega_servicio').val(fecha_entrega_servicio);
      modal.find('.modal-body #id_categoria').val(id_categoria);
      modal.find('.modal-body #id_equipo').val(id_equipo);
    })

    /*MODAL ESTADO EQUIPO*/
    $('#cambiarEstado').on('show.bs.modal', function(event) {
      var modal     = $(this)
      var button    = $(event.relatedTarget)
      var id_equipo = button.data('id_equipo')
    
      let form = modal.find('.modal-body #form-delete-equipo')
      form.attr('action', form.attr('action').replace('test', id_equipo) )
      modal.find('.modal-body #id_equipo').val(id_equipo)
    })

    /*MODAL EDITAR PROVEEDOR*/
    $('#abrirmodalEditar').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)

      var nombre_modal_editar = button.data('nombre')
      var tipo_documento_modal_editar = button.data('tipo_documento')
      var num_documento_modal_editar = button.data('num_documento')
      var direccion_modal_editar = button.data('direccion')
      var telefono_modal_editar = button.data('telefono')
      var email_modal_editar = button.data('email')
      var id_proveedor = button.data('id_proveedor')
      var modal = $(this)
      // modal.find('.modal-title').text('New message to ' + recipient)
      /*los # son los id que se encuentran en el formulario*/
      modal.find('.modal-body #nombre').val(nombre_modal_editar);
      modal.find('.modal-body #tipo_documento').val(tipo_documento_modal_editar);
      modal.find('.modal-body #num_documento').val(num_documento_modal_editar);
      modal.find('.modal-body #direccion').val(direccion_modal_editar);
      modal.find('.modal-body #telefono').val(telefono_modal_editar);
      modal.find('.modal-body #email').val(email_modal_editar);
      modal.find('.modal-body #id_proveedor').val(id_proveedor);
    })

    /*EDITAR CLIENTE EN VENTANA MODAL*/
    $('#abrirmodalEditar').on('show.bs.modal', function(event) {

      //console.log('modal abierto');
      /*el button.data es lo que está en el button de editar*/
      var button = $(event.relatedTarget)

      var nombre_modal_editar = button.data('nombre')
      var tipo_documento_modal_editar = button.data('tipo_documento')
      var num_documento_modal_editar = button.data('num_documento')
      var direccion_modal_editar = button.data('direccion')
      var telefono_modal_editar = button.data('telefono')
      var email_modal_editar = button.data('email')
      var id_cliente = button.data('id_cliente')
      var modal = $(this)
      // modal.find('.modal-title').text('New message to ' + recipient)
      /*los # son los id que se encuentran en el formulario*/
      modal.find('.modal-body #nombre').val(nombre_modal_editar);
      modal.find('.modal-body #tipo_documento').val(tipo_documento_modal_editar);
      modal.find('.modal-body #num_documento').val(num_documento_modal_editar);
      modal.find('.modal-body #direccion').val(direccion_modal_editar);
      modal.find('.modal-body #telefono').val(telefono_modal_editar);
      modal.find('.modal-body #email').val(email_modal_editar);
      modal.find('.modal-body #id_cliente').val(id_cliente);
    })

    /*EDITAR USUARIO EN VENTANA MODAL*/
    $('#abrirmodalEditar').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)

      var nombre_modal_editar         = button.data('nombre')
      var tipo_documento_modal_editar = button.data('tipo_documento')
      var num_documento_modal_editar  = button.data('num_documento')
      var direccion_modal_editar      = button.data('direccion')
      var telefono_modal_editar       = button.data('telefono')
      var email_modal_editar          = button.data('email')
      /*este id_rol_modal_editar selecciona la categoria*/
      var id_rol_modal_editar         = button.data('id_rol')
      var usuario_modal_editar        = button.data('usuario')
      //var password_modal_editar = button.data('password')
      var id_usuario = button.data('id_usuario')
      var modal = $(this)
      // modal.find('.modal-title').text('New message to ' + recipient)
      /*los # son los id que se encuentran en el formulario*/
      modal.find('.modal-body #nombre').val(nombre_modal_editar);
      modal.find('.modal-body #tipo_documento').val(tipo_documento_modal_editar);
      modal.find('.modal-body #num_documento').val(num_documento_modal_editar);
      modal.find('.modal-body #direccion').val(direccion_modal_editar);
      modal.find('.modal-body #telefono').val(telefono_modal_editar);
      modal.find('.modal-body #email').val(email_modal_editar);
      modal.find('.modal-body #id_rol').val(id_rol_modal_editar);
      modal.find('.modal-body #usuario').val(usuario_modal_editar);
      //modal.find('.modal-body #password').val(password_modal_editar);
      modal.find('.modal-body #id_usuario').val(id_usuario);
    })

    /*INICIO ventana modal para cambiar el estado del usuario*/
    $('#cambiarEstado').on('show.bs.modal', function(event) {
      var button     = $(event.relatedTarget)
      var id_usuario = button.data('id_usuario')
      var modal      = $(this)
      modal.find('.modal-body #id_usuario').val(id_usuario);
    })

    /*INICIO ventana modal para cambiar estado de Compra*/
    $('#cambiarEstadoCompra').on('show.bs.modal', function(event) {

      //console.log('modal abierto');

      var button = $(event.relatedTarget)
      var id_compra = button.data('id_compra')
      var modal = $(this)
      // modal.find('.modal-title').text('New message to ' + recipient)

      modal.find('.modal-body #id_compra').val(id_compra);
    })

    /*INICIO ventana modal para cambiar estado de Venta*/
    $('#cambiarEstadoVenta').on('show.bs.modal', function(event) {

      //console.log('modal abierto');

      var button = $(event.relatedTarget)
      var id_venta = button.data('id_venta')
      var modal = $(this)
      // modal.find('.modal-title').text('New message to ' + recipient)

      modal.find('.modal-body #id_venta').val(id_venta);
    })
  </script>
  <script>
    var nots_counter = $('#notifications-count');

    $('#notifications-dropdown-toggler').click(function(){
      if( nots_counter.attr('count') > 0 ){
        $.get('notifications/markallread', function(data){
          nots_counter.attr('count', 0)
          nots_counter.html(0)
          nots_counter.removeClass('badge-danger').addClass('badge-secondary')
        });
      }
    })
  </script>
  @yield('script')
</body>

</html>