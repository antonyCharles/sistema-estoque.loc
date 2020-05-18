@extends('temps.master')
@section('title', trans('contaReceber.title'))

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
            <h2 class="pageheader-title  d-inline-block"><i class="fas fa-file-alt"></i> @lang('contaReceber.title')</h2>
        </div>
    </div>
</div>

@include('temps.forms.message')

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('contaReceber.subTitleAlterar')</h4>
                <a href="javascript:history.back()" class="btn btn-outline-light btn-sm"><i class="fas fa-angle-left"></i> @lang('botao.Voltar')</a>
            </div>
            <div class="card-body">
                {!! Form::open(['action' => array('ContaReceberController@updatePost', $contaReceber->cr_codigo,$contaReceber->nf_codigo), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
                    {!! Form::hidden('cr_codigo',$contaReceber->cr_codigo) !!}
                    <div class="row">
                        <div class="col-12 col-md-3">
                            @include('temps.forms.input',[
                                        'input' => 'cr_valorconta', 
                                        'label' => trans('label.ValorConta'), 
                                        'value' =>  ViewHelper::getValorMonetarioFormat(old('cr_valorconta',$contaReceber->cr_valorconta ?? null)) , 
                                        'attr' => ['class' => 'form-control valor-monetario', 'id' => 'cr_valorconta','required']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.inputDate',[
                                        'input' => 'cr_datavencimento', 
                                        'label' => trans('label.DataVencimento'), 
                                        'value' => old('cr_datavencimento',$contaReceber->cr_datavencimento ?? null) , 
                                        'attr' => ['class' => 'form-control', 'id' => 'cr_datavencimento','required']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.inputDate',[
                                        'input' => 'cr_datarecebimento', 
                                        'label' => trans('label.DataPagamento'), 
                                        'value' => old('cr_datarecebimento',$contaReceber->cr_datarecebimento ?? null) , 
                                        'attr' => ['class' => 'form-control', 'id' => 'cr_datarecebimento']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.input',[
                                        'input' => 'nf_codigo', 
                                        'label' => trans('label.NfCodigo'), 
                                        'value' => old('nf_codigo',$contaReceber->nf_codigo ?? null) , 
                                        'attr' => ['class' => 'form-control disabled', 'id' => 'nf_codigo','readonly']])
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            @include('temps.forms.textarea',[
                                        'input' => 'cr_observacoes', 
                                        'label' => trans('label.Observacoes'), 
                                        'value' => old('cr_observacoes',$contaReceber->cr_observacoes ?? null) , 
                                        'attr' => ['class' => 'form-control', 'id' => 'cr_observacoes','required']])
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



