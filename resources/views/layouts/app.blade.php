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
  <link href="/js/lib/timedropper/timedropper.min.css" rel="stylesheet">
  <link href="/css/libs/modular-admin-html/css/vendor.css" rel="stylesheet">
  <link href="/css/libs/modular-admin-html/css/app.css" rel="stylesheet">
  <link href="/css/layout.css" rel="stylesheet">

  <!-- Scripts -->
  <script src="https://unpkg.com/vue/dist/vue.js"></script>
  <script>
  window.Laravel = <?php echo json_encode([
    'csrfToken' => csrf_token(),
  ]); ?>
  </script>
</head>
<body>
  <div class="main-wrapper">
    @include('components.header')

    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    <div class="app sidebar-fixed" id="app">
      @include('components.sidebar')
      @yield('content')
    </div>
  </div>
</div>

  <!-- Scripts -->
  <script src="/js/app.js"></script>
  <script src="/js/lib/timedropper/timedropper.min.js"></script>
  <script src="/js/lib/highcharts/highcharts.js"></script>
  <script src="/js/main.js"></script>
  <script>
    var e = document.querySelector('#sidebar-collapse-btn');
    e.onclick = function() {
      document.querySelector('.sidebar').style.left = '0';
    };
  </script>
</body>
</html>
