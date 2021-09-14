<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
<a href="{{ route('painel.index')}}" class="brand-link">
    <img src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png')}}"
         alt="AdminLTE Logo"
         class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">Teofania - MotoBike</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Painel
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="{{ route('painel.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Principal</p>
              </a>
            </li>
            
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Gerenciamento
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="{{route('usuarios.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Usuários</p>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a href="../../index3.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Clientes</p>
              </a>
            </li> --}}
            <li class="nav-item">
              <a href="/teofaniamotobike/public/produtos" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Produtos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/teofaniamotobike/public/estoque" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Estoque</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/teofaniamotobike/public/entradas" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Entradas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/teofaniamotobike/public/saidas" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Saídas</p>
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