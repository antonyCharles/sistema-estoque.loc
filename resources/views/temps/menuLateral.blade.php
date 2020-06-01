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
            @if(Auth::user()->hasRole(trans('roles.compraRead')))
            <li class="nav-item border-bottom">
                <a class="nav-link" href="{{ action('CompraController@list') }}"><i
                        class="fas fa-dolly"></i>@lang('global.aTxtCompra')</a>
            </li>
            @endif
            
            @if(Auth::user()->hasRole(trans('roles.vendaRead')))
            <li class="nav-item border-bottom">
                <a class="nav-link" href="{{ action('VendaController@list') }}"><i
                        class="fas fa-shopping-cart"></i>@lang('global.aTxtVenda')</a>
            </li>
            @endif
            
            @if(Auth::user()->hasRole(trans('roles.notaFiscalRead')))
            <li class="nav-item border-bottom">
                <a class="nav-link" href="{{ action('NotaFiscalController@list') }}"><i
                        class="fas fa-file-alt"></i>@lang('global.aTxtNotaFiscal')</a>
            </li>
            @endif
            
            @if(Auth::user()->hasRole(trans('roles.produtoRead')))
            <li class="nav-item border-bottom">
                <a class="nav-link" href="{{ action('ProdutoController@list') }}"><i
                        class="fas fa-box"></i>@lang('global.aTxtProduto')</a>
            </li>
            @endif
            
            @if(Auth::user()->hasRole(trans('roles.fornecedorRead')))
            <li class="nav-item border-bottom">
                <a class="nav-link" href="{{ action('FornecedorController@list') }}">
                    <i class="fas fa-building"></i>@lang('global.aTxtFornecedor')
                </a>
            </li>
            @endif
            
            @if(Auth::user()->hasAnyRole([trans('roles.tipoProduto'),trans('roles.tipoPagto')]))
            <li class="nav-item border-bottom">
                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1"
                    aria-controls="submenu-1">
                    <i class="fas fa-clipboard-list"></i>Categorias
                </a>
                <div id="submenu-1" class="collapse submenu" style="">
                    <ul class="nav flex-column">
                        @if(Auth::user()->hasRole(trans('roles.tipoProdutoRead')))
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ action('TipoProdutoController@list') }}">@lang('global.aTxtTipoProduto')</a>
                        </li>
                        @endif

                        @if(Auth::user()->hasRole(trans('roles.tipoPagtoRead')))
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ action('TipoPagtoController@list') }}">@lang('global.aTxtTipoPagto')</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif

            @if(Auth::user()->hasRole(trans('roles.userRead')))
            <li class="nav-item border-bottom">
                <a class="nav-link" href="{{ action('FuncionarioController@list') }}">
                    <i class="fas fa-user"></i>@lang('global.aTxtFuncionario')
                </a>
            </li>
            @endif
            
            @if(
                Auth::user()->hasAnyRole([
                    trans('roles.parameter'),
                    trans('roles.groupParameter'),
                    trans('roles.profile'),
                    trans('roles.system')])
            )
            <li class="nav-item border-bottom">
                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2"
                    aria-controls="submenu-2">
                    <i class="fas fa-cog"></i>Configurações
                </a>
                <div id="submenu-2" class="collapse submenu" style="">
                    <ul class="nav flex-column">
                        @if(Auth::user()->hasRole(trans('roles.parameterRead')))
                        <li class="nav-item">
                            <a href="{{ action('ParameterController@list') }}" class="nav-link">@lang('global.parameters')</a>
                        </li>
                        @endif
                        
                        @if(Auth::user()->hasRole(trans('roles.groupParameterRead')))
                        <li class="nav-item">
                            <a href="{{ action('GroupParameterController@list') }}" class="nav-link">@lang('global.groups')</a>
                        </li>
                        @endif
                        
                        @if(Auth::user()->hasRole(trans('roles.profileRead')))
                        <li class="nav-item">
                            <a href="{{ action('ProfileController@list') }}" class="nav-link">@lang('global.profiles')</a>
                        </li>
                        @endif
                        
                        @if(Auth::user()->hasRole(trans('roles.systemRead')))
                        <li class="nav-item">
                            <a href="{{ action('SystemController@detail') }}" class="nav-link">@lang('global.system')</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif
        </ul>
    </div>
</nav>