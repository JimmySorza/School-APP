<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <script src="https://kit.fontawesome.com/0448ad8c55.js" crossorigin="anonymous"></script>
    </head>
    <body>
      <div id="app"></div>
      <script defer src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
