@extends('temps.master')
@section('title', trans('produto.title'))
@section('title-icone', 'fas fa-box')

@section('css-view')

@endsection

@section('js-view')

@endsection

@section('conteudo-view')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
                <h4 class="card-title">@lang('produto.subTitleDeletar')</h4>
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
                                    @include('temps.tables.trHorizontal',['label' => __('label.Descricao'), 'value' => $produto->pro_descricao])
                                    @include('temps.tables.trHorizontal',['label' => __('label.TipoProduto'), 'value' => $produto->tipoProduto->tpp_descricao])
                                    @include('temps.tables.trHorizontal',['label' => __('label.PrecoCusto'), 'value' => 'R$ ' . ViewHelper::getValorMonetarioFormat($produto->pro_precocusto)])
                                    @include('temps.tables.trHorizontal',['label' => __('label.PrecoVenda'), 'value' => 'R$ ' . ViewHelper::getValorMonetarioFormat($produto->pro_precovenda)])
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col1-12 col-md-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @include('temps.tables.trHorizontal',['label' => __('label.Estoque'), 'value' => $produto->pro_estoque])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Embalagem'), 'value' => $produto->pro_embalagem])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Ipi'), 'value' => 'R$ ' . ViewHelper::getValorMonetarioFormat($produto->pro_ipi)])
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->hasRole(trans('roles.produtoDelete')))
                <div class="row">
                    <div class="col-12 text-center">
                        <hr/>
                        <h3>@lang('msg.ConfirmacaoDelete')</h3>
                        {!! Form::open(['action' => array('ProdutoController@deletePost',$produto->pro_codigo ?? null), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
                            {!! Form::hidden('pro_codigo',$produto->pro_codigo) !!}
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
