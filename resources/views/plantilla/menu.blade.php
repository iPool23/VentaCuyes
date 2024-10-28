<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-blue elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/image.png') }}" alt="SMarket Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Ventas Cuyes</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('perfiles/user-avatar.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ $usuario->nombres ?? 'Invitado' }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('gestionar*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('gestionar*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Gestionar
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="" class="nav-link {{ Request::is('gestionar/cuyes*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cuyes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link {{ Request::is('gestionar/clientes*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Clientes</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ Request::is('seguridad*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('seguridad*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shield-alt"></i>
                        <p>
                            Seguridad
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('usuario.index') }}" class="nav-link {{ Request::is('seguridad/usuario*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Usuario</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>