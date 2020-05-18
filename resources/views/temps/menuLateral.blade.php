<nav class="navbar navbar-expand-lg navbar-light">
    <a class="d-xl-none d-lg-none" href="#">@lang('global.aTxtMenu')</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav flex-column">
            <li class="nav-item border-bottom">
                <a class="nav-link" href="{!! url('/'); !!}"><i
                        class="fa-fw fas fa-home"></i>@lang('global.aTxtHome')</a>
            </li>
            <li class="nav-item border-bottom">
                <a class="nav-link" href="{{ action('CompraController@list') }}"><i
                        class="fas fa-dolly"></i>@lang('global.aTxtCompra')</a>
            </li>
            <li class="nav-item border-bottom">
                <a class="nav-link" href="{{ action('VendaController@list') }}"><i
                        class="fas fa-shopping-cart"></i>@lang('global.aTxtVenda')</a>
            </li>
            <li class="nav-item border-bottom">
                <a class="nav-link" href="{{ action('NotaFiscalController@list') }}"><i
                        class="fas fa-file-alt"></i>@lang('global.aTxtNotaFiscal')</a>
            </li>
            <li class="nav-item border-bottom">
                <a class="nav-link" href="{{ action('ProdutoController@list') }}"><i
                        class="fas fa-box"></i>@lang('global.aTxtProduto')</a>
            </li>
            <li class="nav-item border-bottom">
                <a class="nav-link" href="{{ action('FornecedorController@list') }}"><i
                        class="fas fa-building"></i>@lang('global.aTxtFornecedor')</a>
            </li>
            <li class="nav-item border-bottom">
                <a class="nav-link" href="{{ action('FuncionarioController@list') }}"><i
                        class="fas fa-users"></i>@lang('global.aTxtFuncionario')</a>
            </li>
            <li class="nav-item border-bottom">
                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1"
                    aria-controls="submenu-1">
                    <i class="fas fa-clipboard-list"></i>Categorias
                </a>
                <div id="submenu-1" class="collapse submenu" style="">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ action('TipoProdutoController@list') }}">@lang('global.aTxtTipoProduto')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ action('TipoPagtoController@list') }}">@lang('global.aTxtTipoPagto')</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>