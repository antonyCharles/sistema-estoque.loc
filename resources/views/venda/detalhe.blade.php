@extends('temps.master')
@section('title', trans('venda.title'))

@section('css-view')
@endsection

@section('js-view')
@endsection

@section('conteudo-view')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header border-bottom">
            <h2 class="pageheader-title  d-inline-block"><i class="fas fa-shopping-cart"></i> @lang('venda.title')</h2>
        </div>
    </div>
</div>

@include('temps.forms.message')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
                <h4 class="card-title">@lang('venda.subTitleDetalhe')</h4>
                <a href="javascript:history.back()" class="btn btn-outline-light btn-sm"><i class="fas fa-angle-left"></i> @lang('botao.Voltar')</a>
            </div>
			<div class="card-body">
                <div class="row">
                    <div class="col1-12 col-md-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @include('temps.tables.trHorizontal',['label' => __('label.Codigo'), 'value' => $venda->ven_codigo])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Funcionario'), 'value' => $venda->funcionario->fun_nome])
                                    @include('temps.tables.trHorizontal',['label' => __('label.TipoPagto'), 'value' => $venda->tipopagto->tpg_descricao])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Observacoes'), 'value' => $venda->ven_observacoes])
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col1-12 col-md-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @include('temps.tables.trHorizontal',['label' => __('label.DataCompra'), 'value' => ViewHelper::getDateFormat($venda->ven_datavenda)])
                                    @include('temps.tables.trHorizontal',['label' => __('label.ValorTotal'), 'value' => 'R$ ' . ViewHelper::getValorMonetarioFormat($venda->ven_valortotal)])
                                    @include('temps.tables.trHorizontal',['label' => __('label.NotaFiscal'), 'value' => $venda->nf_codigo])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Status'), 'value' => ViewHelper::getEnumLabel($enumStatus,$venda->ven_status)])
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
			</div>
		</div>

        <div class="card">
			<div class="card-header">
                <h4 class="card-title">@lang('venda.subItensCompra')</h4>
            </div>
			<div class="card-body">
            @if(isset($venda->itensvendas) && count($venda->itensvendas) > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">@lang('label.Produto')</th>
                                <th scope="col">@lang('label.Embalagem')</th>
                                <th scope="col">@lang('label.Qtde')</th>
                                <th scope="col">@lang('label.PrecoUnitario')</th>
                                <th scope="col">@lang('label.Desconto')</th>
                                <th class="text-center" scope="col">@lang('label.ValorTotal')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($venda->itensvendas as $i)
                                <tr>
                                    <td>{{ $i->produto->pro_descricao }}</td>
                                    <td>{{ $i->itv_embalagem }}</td>
                                    <td>{{ $i->itv_qtde }}</td>
                                    <td>R$ {{ ViewHelper::getValorMonetarioFormat($i->itv_valorun) }}</td>
                                    <td>R$ {{ ViewHelper::getValorMonetarioFormat($i->itv_desc) }}</td>
                                    <td class="text-center">R$ {{ ViewHelper::getValorMonetarioFormat($i->itv_valortotal) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-secondary">
                                <th class="text-right lead" colspan="5">@lang('label.ValorTotal')</th>
                                <th class="text-center lead">R$ {{ ViewHelper::getValorMonetarioFormat($venda->ven_valortotal) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @else
                <div class="alert alert-secondary" role="alert">
                    @lang('msg.tabelaSemRegistros')
                </div>
            @endif
			</div>
		</div>

        <div class="card">
			<div class="card-header">
                <h4 class="card-title">@lang('notaFiscal.subTitleDetalhe')</h4>
                <a href="{{ action('NotaFiscalController@detalhe',$venda->notafiscal->nf_codigo) }}" class="btn btn-primary btn-sm">@lang('botao.Detalhes')</a>
            </div>
			<div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-xl-4">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @include('temps.tables.trHorizontal',['label' => __('label.Codigo'), 'value' => $venda->notafiscal->nf_codigo])
                                    @include('temps.tables.trHorizontal',['label' => __('label.TaxaImpostoNf'), 'value' => $venda->notafiscal->nf_taxaimpostonf . '%'])
                                    @include('temps.tables.trHorizontal',['label' => __('label.ValorImposto'), 'value' => 'R$ ' . ViewHelper::getValorMonetarioFormat($venda->notafiscal->nf_valorimposto)])
                                    @include('temps.tables.trHorizontal',['label' => __('label.ValorNf'), 'value' => 'R$ ' . ViewHelper::getValorMonetarioFormat($venda->notafiscal->nf_valornf)])
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="card">
                            <h5 class="card-header">@lang('contaReceber.title')</h5>
                            <div class="card-body">
                                @if(isset($venda->notafiscal->contasReceber) && count($venda->notafiscal->contasReceber) > 0)
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">@lang('label.DataVencimento')</th>
                                                    <th scope="col">@lang('label.DataRecebimento')</th>
                                                    <th scope="col">@lang('label.ValorConta')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($venda->notafiscal->contasReceber as $i)
                                                    <tr>
                                                        <td>{{ ViewHelper::getDateFormat($i->cr_datavencimento) }}</td>
                                                        <td>{{ ViewHelper::getDateFormat($i->cr_datarecebimento) }}</td>
                                                        <td>R$ {{ ViewHelper::getValorMonetarioFormat($i->cr_valorconta) }}</td>
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
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="card">
                        <h5 class="card-header">@lang('contaPagar.title')</h5>
                            <div class="card-body">
                                @if(isset($venda->notafiscal->contasPagar) && count($venda->notafiscal->contasPagar) > 0)
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">@lang('label.DataVencimento')</th>
                                                    <th scope="col">@lang('label.DataRecebimento')</th>
                                                    <th scope="col">@lang('label.ValorConta')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($venda->notafiscal->contasPagar as $i)
                                                    <tr>
                                                        <td>{{ ViewHelper::getDateFormat($i->cp_datavencimento) }}</td>
                                                        <td>{{ ViewHelper::getDateFormat($i->cp_datarecebimento) }}</td>
                                                        <td>R$ {{ ViewHelper::getValorMonetarioFormat($i->cp_valorconta) }}</td>
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
			</div>
		</div>
	</div>
</div>

@endsection
