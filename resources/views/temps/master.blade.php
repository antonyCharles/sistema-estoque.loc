<!doctype html>
<html lang="pt-br">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}"/>
    <link href="{{ asset('vendor/fonts/circular-std/style.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('libs/css/template.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor/fonts/fontawesome/css/fontawesome-all.css') }}"/>
    @yield('css-view')
    <title>@yield('title') - Sistema Estoque</title>
</head>

<body>
    <div class="dashboard-main-wrapper">
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="{!! url('/'); !!}">Fatec <span>Sistema de Estoque</span></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('images/avatar-1.jpg') }}" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">Antony Charles</h5>
                                    <span class="status"></span><span class="ml-2">charles@gmail.com</span>
                                </div>
                                <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i> @lang('global.aTxtConta')</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i> @lang('global.aTxtConfiguracao')</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-power-off mr-2"></i> @lang('global.aTxtSair')</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="nav-left-sidebar">
            <div class="menu-list">
                @include('temps.menuLateral')
            </div>
        </div>
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                     @yield('conteudo-view')
                </div>
                <div class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                © 2018 FATEC - Sistema de Estoque. All rights reserved. Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <script src="{{ asset('vendor/jquery/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
        <script src="{{ asset('vendor/slimscroll/jquery.slimscroll.js') }}"></script>
        @yield('js-view')
        <script src="{{ asset('libs/js/template.js') }}"></script>
        @yield('js-code-view')
</body>
</html>