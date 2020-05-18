@extends('temps.master')
@section('title', trans('compra.title'))

@section('css-view')
@endsection

@section('js-view')
@endsection

@section('conteudo-view')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header border-bottom">
            <h2 class="pageheader-title  d-inline-block"><i class="fas fa-dolly"></i> @lang('compra.title')</h2>
        </div>
    </div>
</div>

@include('temps.forms.message')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('compra.subTitleListar')</h4>
                <a href="{{ action('CompraController@create') }}" class="btn btn-success btn-sm">@lang('botao.Incluir')</a>
            </div>
            <div class="card-body">
                @if(isset($compras) && count($compras) > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('label.Codigo')</th>
                                    <th scope="col">@lang('label.Fornecedor')</th>
                                    <th scope="col">@lang('label.TipoPagto')</th>
                                    <th scope="col">@lang('label.DataCompra')</th>
                                    <th scope="col">@lang('label.ValorTotal')</th>
                                    <th scope="col">@lang('label.Status')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($compras as $i)
                                    <tr>
                                        <td>{{ $i->com_codigo }}</td>
                                        <td>{{ $i->fornecedor->for_nome }}</td>
                                        <td>{{ $i->tipopagto->tpg_descricao }}</td>
                                        <td>{{ ViewHelper::getDateFormat($i->com_datacompra) }}</td>
                                        <td>R$ {{ ViewHelper::getValorMonetarioFormat($i->com_valortotal) }}</td>
                                        <td>{{ ViewHelper::getEnumLabel($enumStatus,$i->com_status) }}</td>
                                        <td class="text-right">
                                            <div class="btn-group ml-auto">
                                                <a href="{{ action('CompraController@detalhe', $i->com_codigo) }}" class="btn btn-sm btn-outline-light">@lang('botao.Detalhes')</a>
                                                <a href="{{ action('CompraController@update', $i->com_codigo) }}" class="btn btn-sm btn-outline-light">@lang('botao.Alterar')</a>
                                                <a href="{{ action('CompraController@clonar', $i->com_codigo) }}" class="btn btn-sm btn-outline-light">@lang('botao.Clonar')</a>
                                                <a href="{{ action('CompraController@delete', $i->com_codigo) }}" class="btn btn-sm btn-outline-light">
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



