<!DOCTYPE html>
<html lang="en">
@includeIf('painel.template.head')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @includeIf('painel.template.preloader')

    @includeIf('painel.template.navbar')
  <!-- Main Sidebar Container -->
  @includeIf('painel.template.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @includeIf('painel.template.header')
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          @yield('content')
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    @includeIf('painel.template.footer')

    @includeIf('painel.template.aside')

</div>
<!-- ./wrapper -->
@includeIf('painel.template.javascript')

</body>
</html>
