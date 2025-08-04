<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    @include('partials.preloader')
    @include('partials.navbar')

    @include('partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
            @yield('content')
        </div><!--/. container-fluid -->
      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
    @include('partials.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
    @include('partials.scripts')

    @stack('scripts')
</body>

</html>
