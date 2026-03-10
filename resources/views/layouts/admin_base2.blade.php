<?php

  setlocale(LC_MONETARY, 'en_US');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Hargrio | Dashboard</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('admin/assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('admin/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/assets/dist/css/adminlte.min.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('admin/assets/plugins/summernote/summernote-bs4.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('admin/assets/plugins/toastr/toastr.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ url('admin/dashboard') }}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ url('admin/dashboard') }}" class="nav-link">{{Auth::user()->role}}: {{Auth::user()->name}}</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
              class="fas fa-th-large"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ url('admin/dashboard') }}" class="brand-link">
        <img src="{{ asset('site/images/hargrio_favicon.png') }}" width="50" height="50" alt="Hargrio Logo"> <img width="150" height="25" src="{{ asset('site/images/hargrio_logo_white.png') }}" alt="" srcset=""><span>.</span>
      </a>

        <!-- Sidebar Menu -->
        <nav class="mt-10" style="margin-top: 100px ">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="{{ url('admin/dashboard') }}" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            @can('isAdmin')
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-shopping-cart"></i>
                  <p>
                    Products
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('products.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>All Products</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('products.create')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Product(s)</p>
                    </a>
                  </li>
                  
                </ul>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-list-alt"></i>
                  <p>
                    Categories
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('categories.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>All Categories</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('categories.create')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Categories</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-list-alt"></i>
                  <p>
                    Blog
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('posts.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>All Post</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('posts.create')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Post</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-list-alt"></i>
                  <p>
                    Promo Codes
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('promo-codes.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>All Codes</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('promo-codes.create')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Code</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-list-alt"></i>
                  <p>
                    Promotions
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('promotions.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>All Promotions</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('promotions.create')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Promotion</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-image"></i>
                  <p>
                    Visual Journey
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('admin.gallery.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Manage Gallery</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-list-alt"></i>
                  <p>
                    Newsletters
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('newsletters.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>All Newsletters Subscribers</p>
                    </a>
                  </li>
                </ul>
              </li>
            @endcan

            @can('isOrderManager')
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    Orders
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('orders_by_type', 'all') }}" class="nav-link text-primary">
                      <i class="far fa-cart nav-icon"></i>
                      <p>All Orders</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('orders_by_type', 'pending') }}" class="nav-link text-warning">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Pending</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('orders_by_type', 'cancelled') }}" class="nav-link text-danger">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Cancelled</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('orders_by_type', 'shipped') }}" class="nav-link text-primary">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Shipped</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('orders_by_type', 'completed') }}" class="nav-link text-success">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Completed</p>
                    </a>
                  </li>
                </ul>
              </li>
            @endcan
            @can('isAdmin')
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-users"></i>
                  <p>
                    Staff
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link text-primary">
                      <i class="far fa-cart nav-icon"></i>
                      <p>All Staff</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('users.create') }}" class="nav-link text-warning">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Add Staff</p>
                    </a>
                  </li>
                </ul>
              </li>
            @endcan

            <li class="nav-item has-treeview" style="margin-top: 100px">
              <li class="nav-item">
                <form id="logout" style="display: none" action="{{ route('admin-logout') }}" method="post">
                  @csrf
                </form>
                <a href="{{ route('admin-logout') }}" class="nav-link text-danger" 
                onclick="
                event.preventDefault();
                document.getElementById('logout').submit()
                "
                >
                  <i class="fa fa-toggle-off nav-icon"></i>
                  <p>logout</p>
                </a>
              </li>
            </li>            
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @yield('content')

      
    </div>
    <!-- /.content-wrapper -->

    

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <p class="mb-2 text-center text-lg-start">
        Copyright &copy;<script>document.write(new Date().getFullYear());</script> Hargrio Limited. All Rights Reserved.
      </p>
      <div class="float-right d-none d-sm-inline-block">
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="{{asset('admin/assets/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap -->
  <script src="{{asset('admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- overlayScrollbars -->
  <script src="{{asset('admin/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- DataTables -->
  <script src="{{asset('admin/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('admin/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('admin/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('admin/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('admin/assets/dist/js/adminlte.js')}}"></script>

  <!-- OPTIONAL SCRIPTS -->
  <script src="{{asset('admin/assets/dist/js/demo.js')}}"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="{{asset('admin/assets/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
  <script src="{{asset('admin/assets/plugins/raphael/raphael.min.js')}}"></script>
  <script src="{{asset('admin/assets/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
  <script src="{{asset('admin/assets/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
  <!-- ChartJS -->
  <script src="{{asset('admin/assets/plugins/chart.js/Chart.min.js')}}"></script>
  <!-- SweetAlert2 -->
  <script src="{{asset('admin/assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
  <script src="{{asset('admin/assets/plugins/toastr/toastr.min.js')}}"></script>
  <!-- PAGE SCRIPTS -->
  <script src="{{asset('admin/assets/dist/js/pages/dashboard2.js')}}"></script>
  <!-- Summernote -->
  <script src="{{asset('admin/assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
      // Summernote
      $('.textarea').summernote();
    });
  </script>
  <script>
    $(function() {
      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 7000
      });
      var sus = {!! json_encode(session('success')) !!}
      var errors = {!! json_encode(session('errors')) !!}
      var error = {!! json_encode(session('error')) !!}
      // var success = {!! (session('success')) !!} 
      
      // console.log(success !== null)

      if(errors !== null){
        @foreach($errors->all() as $error)
          toastr.error("{{$error}}")
        @endforeach
      }else if(sus !== null){
          toastr.success(sus)
      }else if(error !== null){
          toastr.error(error)
      }

    });

    // $(document).ready(function(){
    //   document.getElementById('reveal-retail').click()
    // })
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        var logoInput = document.getElementById('logoInput');
        var logoPreview = document.getElementById('logoPreview');

        logoInput.addEventListener('change', function (event) {
            var input = event.target;

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    logoPreview.src = e.target.result;
                    logoPreview.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                logoPreview.src = '';
                logoPreview.style.display = 'none';
            }
        });
    });
</script>

@stack('modals')
</body>
</html>
