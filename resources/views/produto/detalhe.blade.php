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
                <h4 class="card-title">@lang('produto.subTitleDetalhe')</h4>
                <a href="{{ URL::previous() }}" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-angle-left"></i> @lang('botao.Voltar')
                </a>
                @if(Auth::user()->hasRole(trans('roles.produtoUpdate')))
                <a href="{{ action('ProdutoController@update',$produto->pro_codigo) }}" class="btn btn-info btn-sm">@lang('botao.Alterar')</a>
                @endif
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
			</div>
		</div>
	</div>
</div>

@endsection
