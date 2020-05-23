@extends('temps.master')
@section('title', trans('tipoProduto.title'))
@section('title-icone', 'fas fa-clipboard-list')

@section('css-view')

@endsection

@section('js-view')
@endsection

@section('conteudo-view')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('tipoProduto.subTitleListar')</h4>
                @if(Auth::user()->hasRole(trans('roles.tipoProdutoCreate')))
                <a href="{{ action('TipoProdutoController@create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> @lang('botao.Incluir')
                </a>
                @endif
            </div>
            <div class="card-body">
                @if(isset($tiposproduto) && count($tiposproduto) > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('label.Descricao')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tiposproduto as $i)
                                    <tr>
                                        <td>{{ $i->tpp_descricao }}</td>
                                        <td class="text-right">
                                            <div class="btn-group ml-auto">
                                                @if(Auth::user()->hasRole(trans('roles.tipoProdutoUpdate')))
                                                <a href="{{ action('TipoProdutoController@update',$i->tpp_codigo) }}" class="btn btn-sm btn-outline-light">@lang('botao.Editar')</a>
                                                @endif
                                                @if(Auth::user()->hasRole(trans('roles.tipoProdutoDelete')))
                                                <a href="{{ action('TipoProdutoController@delete',$i->tpp_codigo) }}" class="btn btn-sm btn-outline-light">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-secondary" role="alert">
                        @lang('msg.tabelaSemRegistros')
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection



