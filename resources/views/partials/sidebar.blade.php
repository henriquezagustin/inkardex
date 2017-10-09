 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        {{-- <li class="header">HEADER</li> --}}
        <!-- Optionally, you can add icons to the links -->
{{--         <li class="active"><a href="{{ route('categories.index', [], false) }}"><i class="fa fa-link"></i> <span>Categorias</span></a></li> --}}
        <li><a href="{{ route('sales.index') }}"><i class="fa fa-folder"></i> <span>Ventas</span></a></li>
        <li><a href="{{ route('products.index') }}"><i class="fa fa-folder"></i> <span>Productos</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-folder"></i> <span>Reportes</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('reports.index') }}"><i class="fa fa-circle-o"></i> <span>Resumen</span></a></li>
            {{-- <li><a href="#">Link in level 2</a></li> --}}
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Configuracion</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('categories.index') }}"><i class="fa fa-circle-o"></i> <span>Categorias</span></a></li>
            <li><a href="{{ route('photos.index') }}"><i class="fa fa-circle-o"></i> <span>Fotografias</span></a></li>
            <li><a href="{{ route('users.index') }}"><i class="fa fa-circle-o"></i> <span>Usuarios</span></a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>