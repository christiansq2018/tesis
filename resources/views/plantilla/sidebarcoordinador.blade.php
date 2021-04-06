<div class="sidebar">
  <nav class="sidebar-nav">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link active" href="{{url('home')}}" onclick="event.preventDefault(); document.getElementById('home-form').submit();"><i class="icon-speedometer"></i> Dashboard</a>

        <form id="home-form" action="{{url('home')}}" method="GET" style="display: none;">
          {{csrf_field()}}
        </form>
      </li>

      <li class="nav-title">
        Menú
      </li>


      <li class="nav-item">
        <a class="nav-link" href="{{route('clasificacion.index')}}" onclick="event.preventDefault(); document.getElementById('clasificacion-form').submit();"><i class="fa fa-list"></i> Clasificaciones</a>

        <form id="clasificacion-form" action="{{route('clasificacion.index')}}" method="GET" style="display: none;">
          {{csrf_field()}}
        </form>

      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{route('proveedor.index')}}" onclick="event.preventDefault(); document.getElementById('proveedor-form').submit();"><i class="fa fa-users"></i> Proveedores</a>
        <form id="proveedor-form" action="{{route('proveedor.index')}}" method="GET" style="display: none;">
          {{csrf_field()}}
        </form>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="{{route('equipo.index')}}" onclick="event.preventDefault(); document.getElementById('equipo-form').submit();"><i class="fa fa-tasks"></i> Equipos</a>
        <form id="equipo-form" action="{{route('equipo.index')}}" method="GET" style="display: none;">
          {{csrf_field()}}
        </form>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="{{route('mantenimiento.index')}}" onclick="event.preventDefault(); document.getElementById('mantenimiento-form').submit();"><i class="fa fa-shopping-cart"></i> Mantenimientos</a>
        <form id="mantenimiento-form" action="{{route('mantenimiento.index')}}" method="GET" style="display: none;">
          {{csrf_field()}}
        </form>
      </li>

    </ul>
  </nav>
  <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>