<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Ventas de Cuyes</title>
  <meta name="robots" content="noindex">
  <meta name="googlebot" content="noindex">
  <link rel="icon" type="image/png" href="{{asset('assets/favicon.ico')}}">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{asset('css/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/adminlte.css')}}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link d-flex align-items-center px-3" data-toggle="dropdown" href="#">
            <img src="{{ $empleado ? asset('empleados/'.$empleado->imagen_perfil) : asset('perfiles/user-avatar.png') }}"
              class="rounded-circle border-2 border-white shadow-sm"
              style="width: 35px; height: 35px; object-fit: cover;"
              alt="{{ $usuario->nombres ?? 'Invitado' }}">
            <span class="mx-2 text-dark">{{ auth()->user()->nombres }}</span>
            <i class="fas fa-chevron-down ms-2" style="font-size: 0.8rem;"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right border-0 shadow-sm"
            style="min-width: 200px; border-radius: 0.5rem; margin-top: 0.5rem;">
            <a href="{{ route('perfil.show') }}" class="dropdown-item py-2 px-4">
              <i class="fas fa-user-cog me-2" style="color: var(--accent-color);"></i>
              <span>Mi Perfil</span>
            </a>
            <div class="dropdown-divider"></div>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="dropdown-item py-2 px-4 text-danger">
                <i class="fas fa-sign-out-alt me-2"></i>
                <span>Cerrar Sesión</span>
              </button>
            </form>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt" style="color: var(--accent-color);"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    @include('plantilla.menu')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper background-color-dashboard">
      <!-- Content Header (Page header) -->
      <div class="content-header">

      </div>
      <!-- /.content-header -->
      @yield('contenido')
    </div>
    <!-- /.content-wrapper -->

    @include('plantilla.footer')
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!--Scripts -->
  <!-- jQuery -->
  <script src="{{asset('js/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('js/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('js/adminlte.min.js')}}"></script>
  <!-- scripts de cada plantilla -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
  @stack('scripts')
</body>

</html>