<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <title>Admin</title>
</head>
<body>
  <div id="app" class="flex">
    <div class="w-[300px] border-r-2 h-screen p-2">
      @include('admin.partials.sidebar')
    </div>
    <div class="flex-1 p-2">
      @include('admin.partials.header')
      <div class="container mx-auto p-5">
        @yield('content')
      </div>
    </div>
  </div>
  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
