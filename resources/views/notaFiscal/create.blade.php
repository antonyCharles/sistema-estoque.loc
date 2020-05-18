@extends('temps.master')
@section('title', trans('notaFiscal.title'))

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
            <h2 class="pageheader-title  d-inline-block"><i class="fas fa-file-alt"></i> @lang('notaFiscal.title')</h2>
        </div>
    </div>
</div>

@include('temps.forms.message')

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('notaFiscal.subTitleCadastrar')</h4>
                <a href="javascript:history.back()" class="btn btn-outline-light btn-sm"><i class="fas fa-angle-left"></i> @lang('botao.Voltar')</a>
            </div>
            <div class="card-body">
                {!! Form::open(['action' => array('NotaFiscalController@createPost'), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
                    <div class="row">
                        <div class="col-12 col-md-4">
                            @include('temps.forms.input',[
                                'input' => 'nf_valornf', 
                                'label' => trans('label.ValorNf'), 
                                'value' => ViewHelper::getValorMonetarioFormat(old('nf_valornf')), 
                                'attr' => ['class' => 'form-control valor-monetario', 'id' => 'nf_valornf','required']])
                        </div>
                        <div class="col-12 col-md-4">
                            @include('temps.forms.input',[
                                'input' => 'nf_taxaimpostonf', 
                                'label' => trans('label.TaxaImpostoNf'), 
                                'value' => ViewHelper::getValorMonetarioFormat(old('nf_taxaimpostonf')), 
                                'attr' => ['class' => 'form-control valor-monetario', 'id' => 'nf_taxaimpostonf','required']])
                        </div>
                        <div class="col-12 col-md-4">
                            @include('temps.forms.input',[
                                'input' => 'nf_valorimposto', 
                                'label' => trans('label.ValorImposto'), 
                                'value' => ViewHelper::getValorMonetarioFormat(old('nf_valorimposto')), 
                                'attr' => ['class' => 'form-control', 'id' => 'nf_valorimposto','disabled']])
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



