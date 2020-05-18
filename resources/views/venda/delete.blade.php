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
                <h4 class="card-title">@lang('venda.subTitleDeletar')</h4>
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
                <div class="row">
                    <div class="col-12 text-center">
                        <hr/>
                        <h3>@lang('msg.ConfirmacaoDelete')</h3>
                        {!! Form::open(['action' => array('VendaController@deletePost',$venda->ven_codigo), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
                            {!! Form::hidden('ven_codigo',$venda->ven_codigo) !!}
                            @include('temps.forms.submit',['input' => trans('botao.Deletar'), 'attr' => ['class' => 'btn btn-danger']])
                        {!! Form::close() !!}
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>

@endsection
