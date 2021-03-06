@extends('temps.master')
@section('title', trans('contaPagar.title'))
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
                <h4 class="card-title">@lang('contaPagar.subTitleDeletar')</h4>
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
                                    @include('temps.tables.trHorizontal',['label' => __('label.NfCodigo'), 'value' => $contaPagar->nf_codigo])
                                    @include('temps.tables.trHorizontal',['label' => __('label.ValorConta'), 'value' => 'R$ ' . ViewHelper::getValorMonetarioFormat($contaPagar->cp_valorconta)])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Observacoes'), 'value' => $contaPagar->cp_observacoes])
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col1-12 col-md-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @include('temps.tables.trHorizontal',['label' => __('label.DataVencimento'), 'value' => ViewHelper::getDateFormat($contaPagar->cp_datavencimento)])
                                    @include('temps.tables.trHorizontal',['label' => __('label.DataPagamento'), 'value' => ViewHelper::getDateFormat($contaPagar->cp_datapagamento)])
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <hr/>
                        <h3>@lang('msg.ConfirmacaoDelete')</h3>
                        {!! Form::open(['action' => array('ContaPagarController@deletePost',$contaPagar->cp_codigo,$contaPagar->nf_codigo), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
                            {!! Form::hidden('cp_codigo',$contaPagar->cp_codigo) !!}
                            @include('temps.forms.submit',['input' => trans('botao.Deletar'), 'attr' => ['class' => 'btn btn-danger']])
                        {!! Form::close() !!}
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>

@endsection
