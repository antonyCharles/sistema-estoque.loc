@extends('temps.master')
@section('title', trans('contaPagar.title'))
@section('title-icone', 'fas fa-file-alt')

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
                <h4 class="card-title">@lang('contaPagar.subTitleCadastrar')</h4>
                <a href="{{ URL::previous() }}" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-angle-left"></i> @lang('botao.Voltar')
                </a>
            </div>
            <div class="card-body">
                {!! Form::open(['action' => array('ContaPagarController@createPost',$nf_codigo), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
                    <div class="row">
                        <div class="col-12 col-md-3">
                            @include('temps.forms.input',[
                                        'input' => 'cp_valorconta', 
                                        'label' => trans('label.ValorConta'), 
                                        'value' =>  ViewHelper::getValorMonetarioFormat(old('cp_valorconta')) , 
                                        'attr' => ['class' => 'form-control valor-monetario', 'id' => 'cp_valorconta','required']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.inputDate',[
                                        'input' => 'cp_datavencimento', 
                                        'label' => trans('label.DataVencimento'), 
                                        'value' => old('cp_datavencimento') , 
                                        'attr' => ['class' => 'form-control', 'id' => 'cp_datavencimento','required']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.inputDate',[
                                        'input' => 'cp_datapagamento', 
                                        'label' => trans('label.DataPagamento'), 
                                        'value' => old('cp_datapagamento') , 
                                        'attr' => ['class' => 'form-control', 'id' => 'cp_datapagamento']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.input',[
                                        'input' => 'nf_codigo', 
                                        'label' => trans('label.NfCodigo'), 
                                        'value' => old('nf_codigo',$nf_codigo ?? null) , 
                                        'attr' => ['class' => 'form-control disabled', 'id' => 'nf_codigo','readonly']])
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            @include('temps.forms.textarea',[
                                        'input' => 'cp_observacoes', 
                                        'label' => trans('label.Observacoes'), 
                                        'value' => old('cp_observacoes') , 
                                        'attr' => ['class' => 'form-control', 'id' => 'cp_observacoes','required']])
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



