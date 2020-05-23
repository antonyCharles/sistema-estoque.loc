@extends('temps.master')
@section('title', trans('produto.title'))
@section('title-icone', 'fas fa-box')

@section('css-view')

@endsection

@section('js-view')
<script src="{{ asset('vendor/parsley/parsley.js') }}"></script>
<script src="{{ asset('libs/js/ativa-mensagem-validador-form.js') }}"></script>
@endsection

@section('conteudo-view')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('produto.subTitleCadastrar')</h4>
                <a href="{{ URL::previous() }}" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-angle-left"></i> @lang('botao.Voltar')
                </a>
            </div>
            <div class="card-body">
                {!! Form::open(['action' => array('ProdutoController@createPost'), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
                    <div class="row">
                        <div class="col-12 col-md-4">
                            @include('temps.forms.input',[
                                'input' => 'pro_descricao', 
                                'label' => trans('label.Descricao'), 
                                'value' => old('pro_descricao'), 
                                'attr' => ['class' => 'form-control', 'id' => 'pro_descricao','required']])
                        </div>
                        <div class="col-12 col-md-4">
                            @include('temps.forms.select',[
                                        'input' => 'tpp_codigo',
                                        'label' => trans('label.TipoProduto'), 
                                        'value' => old('tpp_codigo') , 
                                        'list' => $tiposProduto, 
                                        'attr' => ['placeholder' => trans('global.selecione'),'class' => 'form-control', 'id' => 'tpp_codigo','required']])
                        </div>
                        <div class="col-12 col-md-2">
                            @include('temps.forms.input',[
                                'input' => 'pro_precocusto', 
                                'label' => trans('label.PrecoCusto'), 
                                'value' => ViewHelper::getValorMonetarioFormat(old('pro_precocusto')), 
                                'attr' => ['class' => 'form-control valor-monetario', 'id' => 'pro_precocusto','required']])
                        </div>
                        <div class="col-12 col-md-2">
                            @include('temps.forms.input',[
                                'input' => 'pro_precovenda', 
                                'label' => trans('label.PrecoVenda'), 
                                'value' => ViewHelper::getValorMonetarioFormat(old('pro_precovenda')), 
                                'attr' => ['class' => 'form-control valor-monetario', 'id' => 'pro_precovenda','required']])
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-12 col-md-2">
                            @include('temps.forms.number',[
                                'input' => 'pro_estoque', 
                                'label' => trans('label.Estoque'), 
                                'value' => old('pro_estoque'), 
                                'attr' => ['class' => 'form-control', 'id' => 'pro_estoque','required']])
                        </div>
                        <div class="col-12 col-md-2">
                            @include('temps.forms.input',[
                                'input' => 'pro_embalagem', 
                                'label' => trans('label.Embalagem'), 
                                'value' => old('pro_embalagem'), 
                                'attr' => ['class' => 'form-control', 'id' => 'pro_embalagem','required']])
                        </div>
                        <div class="col-12 col-md-2">
                            @include('temps.forms.input',[
                                'input' => 'pro_ipi', 
                                'label' => trans('label.Ipi'), 
                                'value' => ViewHelper::getValorMonetarioFormat(old('pro_ipi')), 
                                'attr' => ['class' => 'form-control valor-monetario', 'id' => 'pro_ipi','required']])
                        </div>
                    </div>
                    <br/>
                    <div class="row t-2">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                            @include('temps.forms.submit',['input' => trans('botao.Incluir'), 'attr' => ['class' => 'btn btn-primary']])
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection



