<nav class="navbar is-dark" role="navigation" aria-label="main navigation" x-data="{ menuActive: false}">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="{{ route('home') }}">
                <img src="/img/logoiogrw.png" width="141" height="31">
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbar"
                @click.prevent="menuActive = !menuActive" :class="menuActive ? 'is-active' : ''">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbar" class="navbar-menu has-background-dark" :class="menuActive ? 'is-active' : ''">
            <div class="navbar-start">
            </div>
            <div class="navbar-end">
                <a class="navbar-item" href="{{ route('home') }}">
                    Inicio
                </a>

                <a class="navbar-item" href="{{ route('forms.create') }}">
                    Abrir cuenta
                </a>

                @guest
                <!-- No tiene sesión iniciada -->
                @if (Route::has('register'))
                <a class="navbar-item" href="{{ route('register') }}">
                    <strong>Registro</strong>
                </a>
                @endif

                @if (Route::has('login'))
                <a class="navbar-item" href="{{ route('login') }}">
                    Iniciar sesión
                </a>
                @endif

                @else
                <!-- Tiene sesión iniciada -->
                <a class="navbar-item" href="{{ route('admin') }}">
                    Panel
                </a>
                <a class="navbar-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Cerrar sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                @endguest
            </div>
        </div>
    </div>
</nav>