<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>FAT - Sistema Estoque</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}"/>
    <link href="{{ asset('vendor/fonts/circular-std/style.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('libs/css/template.css') }}"/>
    <style>
    html,body {height: 100%;}
    body {display: -ms-flexbox;display: flex;-ms-flex-align: center;align-items: center;padding-top: 40px;padding-bottom: 40px;}
    .navbar-brand{padding:0px;}
    .alert b, .alert a, .alert hr{display:none;}
    .alert ul{list-style-type: none;padding:0px;margin:0px;}
    </style>
</head>
<body>
    @yield('conteudo-view')

    <script src="{{ asset('libs/js/ativa-mensagem-validador-form.js') }}"></script>
</body>
</html>