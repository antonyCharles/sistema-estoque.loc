@extends('temps.master')
@section('title', trans('tipoPagto.title'))

@section('css-view')

@endsection

@section('js-view')

@endsection

@section('conteudo-view')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header border-bottom">
            <h2 class="pageheader-title  d-inline-block"><i class="fas fa-clipboard-list"></i> @lang('tipoPagto.title')</h2>
        </div>
    </div>
</div>

@include('temps.forms.message')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
                <h4 class="card-title">@lang('tipoPagto.subTitleDeletar')</h4>
                <a href="javascript:history.back()" class="btn btn-outline-light btn-sm"><i class="fas fa-angle-left"></i> @lang('botao.Voltar')</a>
                
            </div>
			<div class="card-body">
                <div class="row">
                    <div class="col1-12 col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @include('temps.tables.trHorizontal',['label' => __('label.Descricao'), 'value' => $tipoPagto->tpg_descricao])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Qtde'), 'value' => $tipoPagto->tpg_qtde])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Descricao'), 'value' => ViewHelper::getEnumLabel($enumSimNao,$tipoPagto->tpg_ativo)])
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <hr/>
                        <h3>@lang('msg.ConfirmacaoDelete')</h3>
                        {!! Form::open(['action' => array('TipoPagtoController@deletePost',$tipoPagto->tpg_codigo ?? null), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
                            {!! Form::hidden('tpg_codigo',$tipoPagto->tpg_codigo) !!}
                            @include('temps.forms.submit',['input' => trans('botao.Deletar'), 'attr' => ['class' => 'btn btn-danger']])
                        {!! Form::close() !!}
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>

@endsection
