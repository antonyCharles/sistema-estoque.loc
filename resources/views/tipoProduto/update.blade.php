@extends('temps.master')
@section('title', trans('tipoProduto.title'))

@section('css-view')

@endsection

@section('js-view')
<script src="{{ asset('vendor/parsley/parsley.js') }}"></script>
<script src="{{ asset('libs/js/ativa-mensagem-validador-form.js') }}"></script>
@endsection

@section('conteudo-view')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header border-bottom">
            <h2 class="pageheader-title  d-inline-block"><i class="fas fa-clipboard-list"></i> @lang('tipoProduto.title')</h2>
        </div>
    </div>
</div>

@include('temps.forms.message')

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('tipoProduto.subTitleAlterar')</h4>
                <a href="javascript:history.back()" class="btn btn-outline-light btn-sm"><i class="fas fa-angle-left"></i> @lang('botao.Voltar')</a>
            </div>
            <div class="card-body">
                {!! Form::open(['action' => array('TipoProdutoController@updatePost',$tipoProduto->tpp_codigo), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
                    {!! Form::hidden('tpp_codigo',$tipoProduto->tpp_codigo) !!}
                    <div class="row">
                        <div class="col-12 col-md-12">
                            @include('temps.forms.input',[
                                'input' => 'tpp_descricao', 
                                'label' => trans('label.Descricao'), 
                                'value' => old('tpp_descricao',$tipoProduto->tpp_descricao ?? null), 
                                'attr' => ['class' => 'form-control', 'id' => 'tpp_descricao','required']])
                        </div>
                    </div>
                    <br/>
                    <div class="row t-2">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                            @include('temps.forms.submit',['input' => trans('botao.Alterar'), 'attr' => ['class' => 'btn btn-primary']])
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection


