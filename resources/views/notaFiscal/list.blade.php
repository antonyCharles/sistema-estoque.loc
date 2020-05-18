@extends('temps.master')
@section('title', trans('notaFiscal.title'))

@section('css-view')

@endsection

@section('js-view')
@endsection

@section('conteudo-view')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header border-bottom">
            <h2 class="pageheader-title  d-inline-block"><i class="fas fa-file-alt"></i> @lang('notaFiscal.title')</h2>
        </div>
    </div>
</div>

@include('temps.forms.message')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('notaFiscal.subTitleListar')</h4>
                <a href="{{ action('NotaFiscalController@create') }}" class="btn btn-success btn-sm">@lang('botao.Incluir')</a>
            </div>
            <div class="card-body">
                @if(isset($notasFiscais) && count($notasFiscais) > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('label.Codigo')</th>
                                    <th scope="col">@lang('label.ValorNf')</th>
                                    <th scope="col">@lang('label.TaxaImpostoNf')</th>
                                    <th scope="col">@lang('label.ValorImposto')</th>
                                    <th scope="col">@lang('contaReceber.title')</th>
                                    <th scope="col">@lang('contaPagar.title')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($notasFiscais as $i)
                                    <tr>
                                        <td>{{ $i->nf_codigo }}</td>
                                        <td>{{ 'R$ ' . ViewHelper::getValorMonetarioFormat($i->nf_valornf) }}</td>
                                        <td>{{ $i->nf_taxaimpostonf }}%</td>
                                        <td>{{ 'R$ ' . ViewHelper::getValorMonetarioFormat($i->nf_valorimposto) }}</td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-right">
                                            <div class="btn-group ml-auto">
                                                <a href="{{ action('NotaFiscalController@detalhe',$i->nf_codigo) }}" class="btn btn-sm btn-outline-light">@lang('botao.Detalhes')</a>
                                                <a href="{{ action('NotaFiscalController@update',$i->nf_codigo) }}" class="btn btn-sm btn-outline-light">@lang('botao.Editar')</a>
                                                <a href="{{ action('NotaFiscalController@delete',$i->nf_codigo) }}" class="btn btn-sm btn-outline-light">
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



