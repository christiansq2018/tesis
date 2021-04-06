<li class="nav-item dropdown">
  <a
    id="notifications-dropdown-toggler"
    class="nav-link dropdown-toggle nav-link"
    data-toggle="dropdown"
    href="#"
    role="button"
    aria-haspopup="true"
    aria-expanded="false">
    <i class="fa fa-bell"></i>
    <?php $notifications = auth()->user()->frontend_notifications; ?>
    @if( $notifications['total'] )
    <span
      id="notifications-count"
      class="badge badge-pill @if($notifications['total_unread']) badge-danger @else badge-secondary @endif"
      count="{{ auth()->user()->frontend_notifications['total_unread'] }}"
    >
    {{ auth()->user()->frontend_notifications['total_unread'] }}
    </span>
    @endif
  </a>
  <div class="dropdown-menu dropdown-menu-right">
    <div class="dropdown-header text-center">
      <strong>Notificaciones</strong>
    </div>
    @if( auth()->user()->frontend_notifications['total'] )
    <ul class="list-group">
      @foreach( auth()->user()->frontend_notifications['data'] as $not )
      <li class="list-group-item notification-item" style="width: 250px;">
        <a class="custom-link" href="{{ $not->data['link'] }}">
          <div class="name">
            {{ $not->data['mensaje'] }}
          </div>
          <div class="date" style="font-size: 10px; font-weight: 500;">
            {{ \Carbon\Carbon::parse( $not->data['fecha'] )->diffForHumans() }}
          </div>
        </a>
      </li>
      @endforeach
    </ul>
    <div class="text-center">
      <button class="btn btn-link">
        Marcar como leídas
      </button>
    </div>
    @else
    <div class="alert alert-info m-3 text-center" style="width: 250px;">
      Sin notificaciones
    </div>
    @endif
  </div>
</li>