<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Upload files</title>
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <!-- App css compiled from sass -->
  <link href="{{asset('/css/app.css')}}" rel="stylesheet">
</head>
<body class="antialiased">
<!-- React app container -->
<div id="app"></div>
<!-- App JS compiled from React app -->
<script src="{{asset('/js/app.js')}}"></script>
</body>
</html>
