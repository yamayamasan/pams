<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <!--
  <link href="/bower_components/materialize/dist/css/materialize.css" rel="stylesheet">
  <script src="/bower_components/materialize/dist/js/materialize.js"></script>
  <link href="/css/app.css" rel="stylesheet">
  -->
  <link href="/css/libs/modular-admin-html/css/vendor.css" rel="stylesheet">
  <link href="/css/libs/modular-admin-html/css/app.css" rel="stylesheet">

  <!-- Scripts -->
  <script>
  window.Laravel = <?php echo json_encode([
    'csrfToken' => csrf_token(),
  ]); ?>
  </script>
</head>
<body>
  <div class="main-wrapper">
    <aside class="sidebar">
      <div class="sidebar-container">
        <div class="sidebar-header">
          <div class="brand">
            <div class="logo"> <span class="l l1"></span> <span class="l l2"></span> <span class="l l3"></span> <span class="l l4"></span> <span class="l l5"></span></div>
            Modular Admin
          </div>
        </div>

        <nav class="menu">
          <ul class="nav metismenu" id="sidebar-menu">
            <li><a href="/"> <i class="fa fa-home"></i> Dashboard </a></li>
          </ul>
        </nav>

      </div>
    </aside>
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    <div class="app" id="app">
      @yield('content')
    </div>
  </div>
</div>

  <!-- Scripts -->
  <script src="/js/app.js"></script>
  <script src="/js/main.js"></script>
</body>
</html>
