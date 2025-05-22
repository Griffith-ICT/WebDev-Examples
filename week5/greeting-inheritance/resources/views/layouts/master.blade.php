<!DOCTYPE html>
<html>
<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="{{asset('css/wp.css')}}">
</head>

<body>
  <h1>Greetings @section ('name') user @show</h1>
  @yield('content')
  @include('layouts.greetingFooter')
</body>
</html>