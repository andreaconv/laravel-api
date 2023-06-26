<header class="bg-dark">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.home') }}">
        LOGO
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="{{ route('home') }}">Vai al Sito</a>
          </li>
        </ul>

          <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
          @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
            @endif
            @else
            <li class="nav-item dropdown">

              <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-secondary" type="submit" title="logout"><i class="fa-solid fa-right-from-bracket"></i></button>
              </form>

            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>
</header>
