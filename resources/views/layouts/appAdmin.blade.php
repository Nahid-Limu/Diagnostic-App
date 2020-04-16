<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{!! asset('img/SOFTWARE-ICON.ico') !!}"/>
    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title> @yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="admin/css/datatables.min.css" rel="stylesheet">
    <link href="admin/css/animation.css" rel="stylesheet">
    <link href="admin/css/jquery-ui.min.css" rel="stylesheet">
    
    <style>
      .ErrorMsg {
                color: red;
      }

      .SuccessMsg {
                color: green;
      }
  
      .errorInputBox {
          border: 1px solid red !important;
      }

      .successInputBox {
          border: 1px solid green !important;
      }
    </style>
    @yield('css')

</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
  
        <!-- Sidebar Content -->
        @include('admin.sidebar')
        <!-- Sidebar Content end hare-->
  
      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
  
        <!-- Main Content -->
        <div id="content">
          @include('admin.nav')
            @yield('content')
            
        </div>
        <!-- End of Main Content -->
  
        <!-- Footer -->
        @include('admin.footer')
        <!-- End of Footer -->
  
      </div>
      <!-- End of Content Wrapper -->
  
    </div>
    <!-- End of Page Wrapper -->
  
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
  
    <!-- Bootstrap core JavaScript-->
    <script src="admin/vendor/jquery/jquery.min.js"></script>
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> --}}
    <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
    <!-- Core plugin JavaScript-->
    <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>
  
    <!-- Custom scripts for all pages-->
    <script src="admin/js/sb-admin-2.min.js"></script>
  
    <!-- Page level plugins -->
    <script src="admin/vendor/chart.js/Chart.min.js"></script>
  
    <!-- Page level custom scripts -->
    {{-- <script src="admin/js/demo/chart-area-demo.js"></script>
    <script src="admin/js/demo/chart-pie-demo.js"></script> --}}
    <script src="admin/js/datatables.min.js"></script>
    <script src="admin/js/canvasjs.js"></script>
    
    <script>
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
      });
  </script>
    
    @yield('script')

    <script>
      function onCloseModal(fromName) {
        $('#'+fromName).trigger("reset");
      }
    </script>
  
  </body>

    
</html>
