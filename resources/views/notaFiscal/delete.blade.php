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
                <h4 class="card-title">@lang('notaFiscal.subTitleDeletar')</h4>
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
                @if(Auth::user()->hasRole(trans('roles.notaFiscalDelete')))
                <div class="row">
                    <div class="col-12 text-center">
                        <hr/>
                        <h3>@lang('msg.ConfirmacaoDelete')</h3>
                        {!! Form::open(['action' => array('NotaFiscalController@deletePost',$notaFiscal->nf_codigo ?? null), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
                            {!! Form::hidden('nf_codigo',$notaFiscal->nf_codigo) !!}
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
