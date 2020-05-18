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
                <h4 class="card-title">@lang('notaFiscal.subTitleDetalhe')</h4>
                <a href="{{ action('NotaFiscalController@update',$notaFiscal->nf_codigo) }}" class="btn btn-info btn-sm">@lang('botao.Alterar')</a>
                <a href="javascript:history.back()" class="btn btn-outline-light btn-sm"><i class="fas fa-angle-left"></i> @lang('botao.Voltar')</a>
            </div>
			<div class="card-body">
                <div class="row">
                    <div class="col1-12 col-md-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @include('temps.tables.trHorizontal',['label' => __('label.Codigo'), 'value' => $notaFiscal->nf_codigo])
                                    @include('temps.tables.trHorizontal',['label' => __('label.ValorNf'), 'value' => 'R$ ' . ViewHelper::getValorMonetarioFormat($notaFiscal->nf_valornf)])
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col1-12 col-md-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @include('temps.tables.trHorizontal',['label' => __('label.TaxaImpostoNf'), 'value' => $notaFiscal->nf_taxaimpostonf . '%'])
                                    @include('temps.tables.trHorizontal',['label' => __('label.ValorImposto'), 'value' => 'R$ ' . ViewHelper::getValorMonetarioFormat($notaFiscal->nf_valorimposto)])
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
			</div>
		</div>

        <div class="card">
			<div class="card-header">
                <h4 class="card-title">@lang('contaReceber.title')</h4>
                <a href="{{ action('ContaReceberController@create',$notaFiscal->nf_codigo) }}" class="btn btn-success btn-sm">@lang('botao.Incluir') @lang('contaReceber.title')</a>
            </div>
			<div class="card-body">
            @if(isset($notaFiscal->contasReceber) && count($notaFiscal->contasReceber) > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">@lang('label.ValorConta')</th>
                                <th scope="col">@lang('label.DataVencimento')</th>
                                <th scope="col">@lang('label.DataRecebimento')</th>
                                <th scope="col">@lang('label.Observacoes')</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notaFiscal->contasReceber as $i)
                                <tr>
                                    <td>R$ {{ ViewHelper::getValorMonetarioFormat($i->cr_valorconta) }}</td>
                                    <td>{{ ViewHelper::getDateFormat($i->cr_datavencimento) }}</td>
                                    <td>{{ ViewHelper::getDateFormat($i->cr_datarecebimento) }}</td>
                                    <td>{{ $i->cr_observacoes }}</td>
                                    <td class="text-right">
                                        <div class="btn-group ml-auto">
                                            <a href="{{ action('ContaReceberController@update',['nf_codigo' => $i->nf_codigo, 'id' => $i->cr_codigo ]) }}" class="btn btn-sm btn-outline-light">@lang('botao.Editar')</a>
                                            <a href="{{ action('ContaReceberController@delete',['nf_codigo' => $i->nf_codigo, 'id' => $i->cr_codigo ]) }}" class="btn btn-sm btn-outline-light">
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

        <div class="card">
			<div class="card-header">
                <h4 class="card-title">@lang('contaPagar.title')</h4>
                <a href="{{ action('ContaPagarController@create',$notaFiscal->nf_codigo) }}" class="btn btn-success btn-sm">@lang('botao.Incluir') @lang('contaPagar.title')</a>
           </div>
			<div class="card-body">
            @if(isset($notaFiscal->contasPagar) && count($notaFiscal->contasPagar) > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">@lang('label.ValorConta')</th>
                                <th scope="col">@lang('label.DataVencimento')</th>
                                <th scope="col">@lang('label.DataPagamento')</th>
                                <th scope="col">@lang('label.Observacoes')</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notaFiscal->contasPagar as $i)
                                <tr>
                                    <td>R$ {{ ViewHelper::getValorMonetarioFormat($i->cp_valorconta) }}</td>
                                    <td>{{ ViewHelper::getDateFormat($i->cp_datavencimento) }}</td>
                                    <td>{{ ViewHelper::getDateFormat($i->cp_datapagamento) }}</td>
                                    <td>{{ $i->cp_observacoes }}</td>
                                    <td class="text-right">
                                        <div class="btn-group ml-auto">
                                            <a href="{{ action('ContaPagarController@update',['nf_codigo' => $i->nf_codigo, 'id' => $i->cp_codigo ]) }}" class="btn btn-sm btn-outline-light">@lang('botao.Editar')</a>
                                            <a href="{{ action('ContaPagarController@delete',['nf_codigo' => $i->nf_codigo, 'id' => $i->cp_codigo ]) }}" class="btn btn-sm btn-outline-light">
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
