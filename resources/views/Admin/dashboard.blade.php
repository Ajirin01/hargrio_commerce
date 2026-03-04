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
      <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{Auth::user()->role}}: {{Auth::user()->name}}</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">{{Auth::user()->role}}: {{Auth::user()->name}}</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-shopping-cart"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Products</span>
            <span class="info-box-number">{{ count(($products)) }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>
      
      @can('isAdmin')
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Users</span>
              <span class="info-box-number">{{ count($users) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Orders</span>
              <span class="info-box-number">{{ count($orders) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      @endcan
      
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Monthly Recap Report</h5>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <p class="text-center">
                  @php
                      try{
                        echo "<strong>Sales: ".$months[0]."-".$months[count($months)-1]."</strong>";
                      }catch(Exception $e){
                        echo "<strong>Sales:   </strong>";
                      }
                  @endphp
                  
                  @if (Auth::user()->role == 'admin')
                  <span class="text-danger">Total:</span> <strong>£ {{ number_format( $sales_total ) }}.00</strong></strong>  
                  @endif


                </p>

                <div class="chart">
                  <!-- Sales Chart Canvas -->
                  <canvas id="salesChart" height="180" style="height: 300px;"></canvas>
                </div>
                <!-- /.chart-responsive -->
              </div>
              <!-- /.col -->
              
            </div>
            <!-- /.row -->
          </div>
          
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->


    <!-- Main row -->
    <div class="row">
      @if (Auth::user()->role == 'admin')
        <!-- Left col -->
        <div class="col-md-8">
          <!-- TABLE: LATEST ORDERS -->
          <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Latest Orders</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table m-0">
                  <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Period</th>
                    <th>Status</th>
                    {{-- <th>Popularity</th> --}}
                  </tr>
                  </thead>
                  <tbody>
                    {{-- <input id="products" type="hidden" value="{{json_encode($sale_recap)}}">
                    <input id="months" type="hidden" value="{{json_encode($months)}}"> --}}
                    @foreach ($latest_orders as $order)
                      <tr>
                        <td><a href="pages/examples/invoice.html">{{ $order->id }}</a></td>
                        <td>{{ Carbon\Carbon::parse($order->created_at)->diffForHumans() }}</td>
                        @if ($order->payment_status == 'paid')
                          <td><span class="badge badge-success">{{ $order->status }}</span></td>
                        @endif

                        @if ($order->payment_status == 'pending')
                          <td><span class="badge badge-warning">{{ $order->status }}</span></td>
                        @endif

                        @if ($order->payment_status == 'cancelled')
                          <td><span class="badge badge-danger">{{ $order->status }}</span></td>
                        @endif

                        @if ($order->payment_status == 'complete')
                          <td><span class="badge badge-primary">{{ $order->status }}</span></td>
                        @endif

                        {{-- @if ($order->payment_status == 'confirmed')
                          <td><span class="badge badge-sucess">{{ $order->status }}</span></td>
                        @endif --}}
                        
                        {{-- <td>
                          <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                        </td> --}}
                      </tr>
                    @endforeach
                  
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              {{-- <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a> --}}
              <a href="{{ route('orders_by_type', 'all') }}" class="btn btn-sm btn-secondary float-right">View All Orders</a>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->

      
        <div class="col-md-4">
          <!-- PRODUCT LIST -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Recently Added Products</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <ul class="products-list product-list-in-card pl-2 pr-2">
                @foreach ($latest_products as $product)
                  <li class="item">
                    <div class="product-img">
                      <img src="{{ asset('site/images/'.$product->image) }}" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">{{ $product->name }}
                        <span class="badge badge-warning float-right">£{{ $product->price }}</span></a>
                      <span class="product-description">
                        {{ substr($product->description, 100) }}
                      </span>
                    </div>
                  </li>
                  <!-- /.item -->
                @endforeach
                
              </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
              <a href="{{ route('products.index') }}" class="uppercase">View All Products</a>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
      @endif
      
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!--/. container-fluid -->

      <div style="display: none">
        <button type="button" id="success" class="btn btn-success toastrDefaultSuccess">
            Launch Success Toast
          </button>
        <button type="button" id="error" class="btn btn-danger toastrDefaultError">
            Launch Error Toast
          </button>
          @if (session('errors'))
              <script>
                  var error = document.getElementById('error')
                  console.log(error)
                  error.click()
                  console.log("errors")
              </script>
        
          @endif
          @if (session('success'))
            <script>
                document.getElementById('success').click()
            </script>
              
          @endif
          
      </div>
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
  <!-- Hargrio App -->
  <script src="{{asset('admin/assets/dist/js/adminlte.js')}}"></script>

  <!-- OPTIONAL SCRIPTS -->
  <script src="{{asset('admin/assets/dist/js/demo.js')}}"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="{{asset('admin/assets/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
  <script src="{{asset('admin/assets/plugins/raphael/raphael.min.js')}}"></script>
  <script src="{{asset('admin/assets/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
  {{-- <script src="{{asset('admin/assets/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script> --}}
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
        timer: 3000
      });

      $('.swalDefaultSuccess').click(function() {
        Toast.fire({
          icon: 'success',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.swalDefaultInfo').click(function() {
        Toast.fire({
          icon: 'info',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.swalDefaultError').click(function() {
        Toast.fire({
          icon: 'error',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.swalDefaultWarning').click(function() {
        Toast.fire({
          icon: 'warning',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.swalDefaultQuestion').click(function() {
        Toast.fire({
          icon: 'question',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });

      $('.toastrDefaultSuccess').click(function() {
        toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
      });
      $('.toastrDefaultInfo').click(function() {
        toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
      });
      $('.toastrDefaultError').click(function() {
        toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
      });
      $('.toastrDefaultWarning').click(function() {
        toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
      });

      $('.toastsDefaultDefault').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultTopLeft').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          position: 'topLeft',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultBottomRight').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          position: 'bottomRight',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultBottomLeft').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          position: 'bottomLeft',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultAutohide').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          autohide: true,
          delay: 750,
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultNotFixed').click(function() {
        $(document).Toasts('create', {
          title: 'Toast Title',
          fixed: false,
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultFull').click(function() {
        $(document).Toasts('create', {
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          icon: 'fas fa-envelope fa-lg',
        })
      });
      $('.toastsDefaultFullImage').click(function() {
        $(document).Toasts('create', {
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          image: '../../dist/img/user3-128x128.jpg',
          imageAlt: 'User Picture',
        })
      });
      $('.toastsDefaultSuccess').click(function() {
        $(document).Toasts('create', {
          class: 'bg-success',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultInfo').click(function() {
        $(document).Toasts('create', {
          class: 'bg-info',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultWarning').click(function() {
        $(document).Toasts('create', {
          class: 'bg-warning',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultDanger').click(function() {
        $(document).Toasts('create', {
          class: 'bg-danger',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
      $('.toastsDefaultMaroon').click(function() {
        $(document).Toasts('create', {
          class: 'bg-maroon',
          title: 'Toast Title',
          subtitle: 'Subtitle',
          body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
      });
    });

  </script>

  <script>
    /* global Chart:false */

    $(function () {
      'use strict'

      /* ChartJS
      * -------
      * Here we will create a few charts using ChartJS
      */

      //-----------------------
      // - MONTHLY SALES CHART -
      //-----------------------

      // Get context with jQuery - using jQuery's .get() method.
      var salesChartCanvas = $('#salesChart').get(0).getContext('2d')
      var products = JSON.parse(document.getElementById('products').value)
      var months = JSON.parse(document.getElementById('months').value)
      // var products = document.getElementById('products').value
      
      console.log(products)

      
      var datasets_array = function(products){ 
        var datasets = []
        var color_code = Math.ceil(Math.random(0,17))*10

        products.forEach(product => {
           datasets.push({
            label: product.name,
            backgroundColor: 'rgba('+Number(color_code+Math.ceil(Math.random(10,20)*100))+','+Number(color_code+Math.ceil(Math.random(10,20)*100))+','+Number(color_code+Math.ceil(Math.random(10,20)*100))+','+'0.9)',
            // borderColor: 'rgba(225,225,225,.5)',
            borderColor: 'rgba('+Number(Math.ceil(Math.random(10,20)*200))+','+Number(Math.ceil(Math.random(10,20)*200))+','+Number(Math.ceil(Math.random(10,20)*200))+','+.5+')',
            pointRadius: false,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba('+Number(color_code+Math.ceil(Math.random(10,20)*100)-10)+','+Number(color_code+Math.ceil(Math.random(10,20)*100)-40)+','+Number(color_code+Math.ceil(Math.random(10,20)*100)-20)+','+'1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba('+Number(color_code+Math.ceil(Math.random(10,20)*100))+','+Number(color_code+Math.ceil(Math.random(10,20)*100))+','+Number(color_code+Math.ceil(Math.random(10,20)*100))+','+'1)',
            data: product.data
          })
          color_code += 10;
        });
        return datasets
      }
      

      var salesChartData = {
        labels: months,
        datasets: datasets_array(products)
      }

      var salesChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
          display: false
        },
        scales: {
          xAxes: [{
            gridLines: {
              display: false
            }
          }],
          yAxes: [{
            gridLines: {
              display: false
            }
          }]
        }
      }

      // This will get the first returned node in the jQuery collection.
      // eslint-disable-next-line no-unused-vars
      var salesChart = new Chart(salesChartCanvas, {
        type: 'line',
        data: salesChartData,
        options: salesChartOptions
      }
      )

      //---------------------------
      // - END MONTHLY SALES CHART -
      //---------------------------

      //-------------
      // - PIE CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
      var pieData = {
        labels: [
          'Chrome',
          'IE',
          'FireFox',
          'Safari',
          'Opera',
          'Navigator'
        ],
        datasets: [
          {
            data: [700, 500, 400, 600, 300, 100],
            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
          }
        ]
      }
      var pieOptions = {
        legend: {
          display: false
        }
      }
      // Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      // eslint-disable-next-line no-unused-vars
      var pieChart = new Chart(pieChartCanvas, {
        type: 'doughnut',
        data: pieData,
        options: pieOptions
      })

      //-----------------
      // - END PIE CHART -
      //-----------------

      /* jVector Maps
      * ------------
      * Create a world map with markers
      */
      $('#world-map-markers').mapael({
        map: {
          name: 'usa_states',
          zoom: {
            enabled: true,
            maxLevel: 10
          }
        }
      })
      
    })

  </script>

</body>
</html>
