@extends('temps.master')
@section('title', trans('notaFiscal.title'))
@section('title-icone', 'fas fa-file-alt')

@section('css-view')

@endsection

@section('js-view')
@endsection

@section('conteudo-view')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('notaFiscal.subTitleListar')</h4>
                @if(Auth::user()->hasRole(trans('roles.notaFiscalCreate')))
                <a href="{{ action('NotaFiscalController@create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> @lang('botao.Incluir')
                </a>
                @endif
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
                                    <th class="text-center" scope="col">@lang('contaReceber.title')</th>
                                    <th class="text-center" scope="col">@lang('contaPagar.title')</th>
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
                                        <td class="text-center">
                                            @if($i->contasReceber->count() > 0)
                                                {{ $i->contasReceber->where('cr_datarecebimento','!=',null)->count() }}
                                                pago de
                                                {{ $i->contasReceber->count() }}
                                            @else
                                                - 
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($i->contasPagar->count() > 0)
                                                {{ $i->contasPagar->where('cp_datapagamento','!=',null)->count() }}
                                                pago de
                                                {{ $i->contasPagar->count() }}
                                            @else
                                                - 
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group ml-auto">
                                                @if(Auth::user()->hasRole(trans('roles.notaFiscalRead')))
                                                <a href="{{ action('NotaFiscalController@detalhe',$i->nf_codigo) }}" class="btn btn-sm btn-outline-light">@lang('botao.Detalhes')</a>
                                                @endif
                                                @if(Auth::user()->hasRole(trans('roles.notaFiscalUpdate')))
                                                <a href="{{ action('NotaFiscalController@update',$i->nf_codigo) }}" class="btn btn-sm btn-outline-light">@lang('botao.Editar')</a>
                                                @endif
                                                @if(Auth::user()->hasRole(trans('roles.notaFiscalDelete')))
                                                <a href="{{ action('NotaFiscalController@delete',$i->nf_codigo) }}" class="btn btn-sm btn-outline-light">
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



