@extends('temps.master')
@section('title', trans('contaReceber.title'))
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
                <h4 class="card-title">@lang('contaReceber.subTitleDeletar')</h4>
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
                                    @include('temps.tables.trHorizontal',['label' => __('label.NfCodigo'), 'value' => $contaReceber->nf_codigo])
                                    @include('temps.tables.trHorizontal',['label' => __('label.ValorConta'), 'value' => 'R$ ' . ViewHelper::getValorMonetarioFormat($contaReceber->cr_valorconta)])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Observacoes'), 'value' => $contaReceber->cp_observacoes])
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col1-12 col-md-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @include('temps.tables.trHorizontal',['label' => __('label.DataVencimento'), 'value' => ViewHelper::getDateFormat($contaReceber->cr_datavencimento)])
                                    @include('temps.tables.trHorizontal',['label' => __('label.DataPagamento'), 'value' => ViewHelper::getDateFormat($contaReceber->cr_datapagamento)])
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <hr/>
                        <h3>@lang('msg.ConfirmacaoDelete')</h3>
                        {!! Form::open(['action' => array('ContaReceberController@deletePost',$contaReceber->cr_codigo,$contaReceber->nf_codigo), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
                            {!! Form::hidden('cr_codigo',$contaReceber->cr_codigo) !!}
                            @include('temps.forms.submit',['input' => trans('botao.Deletar'), 'attr' => ['class' => 'btn btn-danger']])
                        {!! Form::close() !!}
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>

@endsection
