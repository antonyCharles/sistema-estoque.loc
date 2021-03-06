@extends('temps.master')
@section('title', trans('compra.title'))
@section('title-icone', 'fas fa-dolly')

@section('css-view')
@endsection

@section('js-view')
@endsection

@section('conteudo-view')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
                <h4 class="card-title">@lang('compra.subTitleDeletar')</h4>
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
                                    @include('temps.tables.trHorizontal',['label' => __('label.Codigo'), 'value' => $compra->com_codigo])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Fornecedor'), 'value' => $compra->fornecedor->for_nome])
                                    @include('temps.tables.trHorizontal',['label' => __('label.TipoPagto'), 'value' => $compra->tipopagto->tpg_descricao])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Observacoes'), 'value' => $compra->com_observacoes])
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col1-12 col-md-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @include('temps.tables.trHorizontal',['label' => __('label.DataCompra'), 'value' => ViewHelper::getDateFormat($compra->com_datacompra)])
                                    @include('temps.tables.trHorizontal',['label' => __('label.ValorTotal'), 'value' => 'R$ ' . ViewHelper::getValorMonetarioFormat($compra->com_valortotal)])
                                    @include('temps.tables.trHorizontal',['label' => __('label.NotaFiscal'), 'value' => $compra->nf_codigo])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Status'), 'value' => ViewHelper::getEnumLabel($enumStatus,$compra->com_status)])
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->hasRole(trans('roles.compraDelete')))
                <div class="row">
                    <div class="col-12 text-center">
                        <hr/>
                        <h3>@lang('msg.ConfirmacaoDelete')</h3>
                        {!! Form::open(['action' => array('CompraController@deletePost',$compra->com_codigo), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
                            {!! Form::hidden('com_codigo',$compra->com_codigo) !!}
                            @include('temps.forms.submit',['input' => trans('botao.Deletar'), 'attr' => ['class' => 'btn btn-danger']])
                        {!! Form::close() !!}
                    </div>
                </div>
                @endif
			</div>
		</div>
	</div>
</div>

@endsection
