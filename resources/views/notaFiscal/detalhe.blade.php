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
                <h4 class="card-title">@lang('notaFiscal.subTitleDetalhe')</h4>
                @if(Auth::user()->hasRole(trans('roles.notaFiscalUpdate')))
                <a href="{{ action('NotaFiscalController@update',$notaFiscal->nf_codigo) }}" class="btn btn-info btn-sm">@lang('botao.Alterar')</a>
                @endif
                <a href="{{ URL::previous() }}" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-angle-left"></i> @lang('botao.Voltar')
                </a>
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
                @if(Auth::user()->hasRole(trans('roles.contaReceberCreate')))
                <a href="{{ action('ContaReceberController@create',$notaFiscal->nf_codigo) }}" class="btn btn-success btn-sm">@lang('botao.Incluir') @lang('contaReceber.title')</a>
                @endif
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
                                            @if(Auth::user()->hasRole(trans('roles.contaReceberUpdate')))
                                            <a href="{{ action('ContaReceberController@update',['nf_codigo' => $i->nf_codigo, 'id' => $i->cr_codigo ]) }}" class="btn btn-sm btn-outline-light">@lang('botao.Editar')</a>
                                            @endif
                                            @if(Auth::user()->hasRole(trans('roles.contaReceberDelete')))
                                            <a href="{{ action('ContaReceberController@delete',['nf_codigo' => $i->nf_codigo, 'id' => $i->cr_codigo ]) }}" class="btn btn-sm btn-outline-light">
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

        <div class="card">
			<div class="card-header">
                <h4 class="card-title">@lang('contaPagar.title')</h4>
                @if(Auth::user()->hasRole(trans('roles.contaPagarCreate')))
                <a href="{{ action('ContaPagarController@create',$notaFiscal->nf_codigo) }}" class="btn btn-success btn-sm">@lang('botao.Incluir') @lang('contaPagar.title')</a>
                @endif
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
                                            @if(Auth::user()->hasRole(trans('roles.contaPagarUpdate')))
                                            <a href="{{ action('ContaPagarController@update',['nf_codigo' => $i->nf_codigo, 'id' => $i->cp_codigo ]) }}" class="btn btn-sm btn-outline-light">@lang('botao.Editar')</a>
                                            @endif
                                            @if(Auth::user()->hasRole(trans('roles.contaPagarDelete')))
                                            <a href="{{ action('ContaPagarController@delete',['nf_codigo' => $i->nf_codigo, 'id' => $i->cp_codigo ]) }}" class="btn btn-sm btn-outline-light">
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

        <div class="card">
			<div class="card-header">
                <h4 class="card-title">@lang('compra.subTitleListar')</h4>
           </div>
			<div class="card-body">
            @if(isset($notaFiscal->compras) && count($notaFiscal->compras) > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">@lang('label.Fornecedor')</th>
                                <th scope="col">@lang('label.DataCompra')</th>
                                <th scope="col">@lang('label.ValorTotal')</th>
                                <th scope="col">@lang('label.Status')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notaFiscal->compras as $i)
                                <tr>
                                    <td>{{ $i->fornecedor->for_nome }}</td>
                                    <td>{{ ViewHelper::getDateFormat($i->com_datacompra) }}</td>
                                    <td>R$ {{ ViewHelper::getValorMonetarioFormat($i->com_valortotal) }}</td>
                                    <td>{{ ViewHelper::getEnumLabel($enumStatus,$i->com_status) }}</td>
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
                <h4 class="card-title">@lang('venda.subTitleListar')</h4>
           </div>
			<div class="card-body">
            @if(isset($notaFiscal->vendas) && count($notaFiscal->vendas) > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">@lang('label.Funcionario')</th>
                                <th scope="col">@lang('label.DataVenda')</th>
                                <th scope="col">@lang('label.ValorTotal')</th>
                                <th scope="col">@lang('label.Status')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notaFiscal->vendas as $i)
                                <tr>
                                    <td>{{ $i->funcionario->name }}</td>
                                    <td>{{ ViewHelper::getDateFormat($i->ven_datavenda) }}</td>
                                    <td>R$ {{ ViewHelper::getValorMonetarioFormat($i->ven_valortotal) }}</td>
                                    <td>{{ ViewHelper::getEnumLabel($enumStatus,$i->ven_status) }}</td>
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
