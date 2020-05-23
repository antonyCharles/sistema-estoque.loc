<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') - Login Laravel</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}"/>
    <link href="{{ asset('vendor/fonts/circular-std/style.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('libs/css/template.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor/fonts/fontawesome/css/fontawesome-all.css') }}"/>
    <style>
    html,body {height: 100%;}
    body {display: -ms-flexbox;display: flex;-ms-flex-align: center;align-items: center;padding-top: 40px;padding-bottom: 40px;}
    .logo-img{width:100%;}
    </style>
</head>
<body>
    @yield('conteudo-view')

    <script src="{{ asset('vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
</body>
</html>