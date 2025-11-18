<nav class="panel" id="sidebar">
  <a class="panel-block {{ request()->routeIs('admin') ? 'is-active' : '' }}" href="{{ route('admin') }}">
    <span class="panel-icon">
      <i class="fas fa-home" aria-hidden="true"></i>
    </span>
    Inicio
  </a>
  <a class="panel-block {{ request()->routeIs('forms*') ? 'is-active' : '' }}" href="{{ route('forms.index') }}">
    <span class="panel-icon">
      <i class="fas fa-clipboard-list" aria-hidden="true"></i>
    </span>
    Solicitudes
  </a>
</nav>