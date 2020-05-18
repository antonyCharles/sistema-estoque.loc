@extends('temps.master')
@section('title', trans('produto.title'))

@section('css-view')

@endsection

@section('js-view')
@endsection

@section('conteudo-view')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header border-bottom">
            <h2 class="pageheader-title  d-inline-block"><i class="fas fa-box"></i> @lang('produto.title')</h2>
        </div>
    </div>
</div>

@include('temps.forms.message')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('produto.subTitleListar')</h4>
                <a href="{{ action('ProdutoController@create') }}" class="btn btn-success btn-sm">@lang('botao.Incluir')</a>
            </div>
            <div class="card-body">
                @if(isset($produtos) && count($produtos) > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('label.Descricao')</th>
                                    <th scope="col">@lang('label.TipoProduto')</th>
                                    <th scope="col">@lang('label.PrecoVenda')</th>
                                    <th scope="col">@lang('label.Estoque')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produtos as $i)
                                    <tr>
                                        <td>{{ $i->pro_descricao }}</td>
                                        <td>{{ $i->tipoProduto->tpp_descricao }}</td>
                                        <td>R$ {{ ViewHelper::getValorMonetarioFormat($i->pro_precovenda) }}</td>
                                        <td>{{ $i->pro_estoque }}</td>
                                        <td class="text-right">
                                            <div class="btn-group ml-auto">
                                                <a href="{{ action('ProdutoController@detalhe',$i->pro_codigo) }}" class="btn btn-sm btn-outline-light">@lang('botao.Detalhes')</a>    
                                                <a href="{{ action('ProdutoController@update',$i->pro_codigo) }}" class="btn btn-sm btn-outline-light">@lang('botao.Editar')</a>
                                                <a href="{{ action('ProdutoController@delete',$i->pro_codigo) }}" class="btn btn-sm btn-outline-light">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
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



