@extends('temps.master')
@section('title', trans('tipoPagto.title'))

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
            <h2 class="pageheader-title  d-inline-block"><i class="fas fa-clipboard-list"></i> @lang('tipoPagto.title')</h2>
        </div>
    </div>
</div>

@include('temps.forms.message')

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('tipoPagto.subTitleCadastrar')</h4>
                <a href="javascript:history.back()" class="btn btn-outline-light btn-sm"><i class="fas fa-angle-left"></i> @lang('botao.Voltar')</a>
            </div>
            <div class="card-body">
                {!! Form::open(['action' => array('TipoPagtoController@createPost'), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
                    <div class="row">
                        <div class="col-12 col-md-4">
                            @include('temps.forms.input',[
                                        'input' => 'tpg_descricao', 
                                        'label' => trans('label.Descricao'), 
                                        'value' => old('tpg_descricao') , 
                                        'attr' => ['class' => 'form-control', 'id' => 'tpg_descricao','required']])
                        </div>
                        <div class="col-12 col-md-4">
                            @include('temps.forms.input',[
                                        'input' => 'tpg_qtde', 
                                        'label' => trans('label.Qtde'), 
                                        'value' => old('tpg_qtde') , 
                                        'attr' => ['class' => 'form-control', 'id' => 'tpg_qtde','required']])
                        </div>
                        <div class="col-12 col-md-4">
                            @include('temps.forms.select',[
                                        'input' => 'tpg_ativo',
                                        'label' => trans('label.Ativo'), 
                                        'value' => old('tpg_ativo'), 
                                        'list' => $enumSimNao, 
                                        'attr' => ['placeholder' => trans('global.selecione'),'class' => 'form-control', 'id' => 'tpg_ativo','required']])
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



