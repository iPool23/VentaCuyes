<!-- Main Sidebar Container -->
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-blue elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link d-flex align-items-center p-3">
        <span class="brand-text ms-2 fw-bold">Venta de Cuyes</span>
    </a>

    <div class="sidebar">
        <!-- User Profile Section -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center ps-3">
            <div class="position-relative">
                <img src="{{ $empleado ? asset('empleados/'.$empleado->imagen_perfil) : asset('perfiles/user-avatar.png') }}"
                    class="rounded-circle border-2 border-white shadow-sm"
                    style="width: 45px; height: 45px; object-fit: cover;"
                    alt="{{ $usuario->nombres ?? 'Invitado' }}">
                <span class="position-absolute bottom-0 end-0 bg-success rounded-circle p-1 border border-white"
                    style="width: 10px; height: 10px;">
                </span>
            </div>
            <div class="info ms-3">
                <a href="#" class="d-block text-decoration-none">{{ $usuario->nombres ?? 'Invitado' }}</a>
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

                <!-- Gestionar Section -->
                @hasanyrole('admin|empleado')
                <li class="nav-item {{ Request::is('gestionar*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('gestionar*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Gestionar
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('plato-cuy.index') }}" class="nav-link {{ Request::is('gestionar/cuyes*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cuyes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('proveedor.index') }}" class="nav-link {{ Request::is('gestionar/proveedor*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Proveedores</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('venta.index') }}" class="nav-link {{ Request::is('gestionar/venta*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ventas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endhasanyrole

                <!-- Seguridad Section - Admin Only -->
                @hasrole('admin')
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
                                <p>Usuarios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('empleado.index') }}" class="nav-link {{ Request::is('seguridad/empleado*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Empleados</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endhasrole

                <!-- Cliente Section -->
                @hasrole('cliente')
                <li class="nav-item">
                    <a href="{{ route('reservas.index') }}" class="nav-link {{ Request::is('reservas*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>Reservar Mesa</p>
                    </a>
                </li>
                @endhasrole

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>