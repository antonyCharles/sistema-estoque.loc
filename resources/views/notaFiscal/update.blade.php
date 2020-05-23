@extends('temps.master')
@section('title', trans('notaFiscal.title'))
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
                <h4 class="card-title">@lang('notaFiscal.subTitleAlterar')</h4>
                <a href="{{ URL::previous() }}" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-angle-left"></i> @lang('botao.Voltar')
                </a>
            </div>
            <div class="card-body">
                {!! Form::open(['action' => array('NotaFiscalController@updatePost',$notaFiscal->nf_codigo), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
                    {!! Form::hidden('nf_codigo',$notaFiscal->nf_codigo) !!}
                    <div class="row">
                        <div class="col-12 col-md-4">
                            @include('temps.forms.input',[
                                'input' => 'nf_valornf', 
                                'label' => trans('label.ValorNf'), 
                                'value' => ViewHelper::getValorMonetarioFormat(old('nf_valornf', $notaFiscal->nf_valornf ?? null)),
                                'attr' => ['class' => 'form-control valor-monetario', 'id' => 'nf_valornf','required']])
                        </div>
                        <div class="col-12 col-md-4">
                            @include('temps.forms.input',[
                                'input' => 'nf_taxaimpostonf', 
                                'label' => trans('label.TaxaImpostoNf'), 
                                'value' => ViewHelper::getValorMonetarioFormat(old('nf_taxaimpostonf', $notaFiscal->nf_taxaimpostonf ?? null)),
                                'attr' => ['class' => 'form-control valor-monetario', 'id' => 'nf_taxaimpostonf','required']])
                        </div>
                        <div class="col-12 col-md-4">
                            @include('temps.forms.input',[
                                'input' => 'nf_valorimposto', 
                                'label' => trans('label.ValorImposto'), 
                                'value' => ViewHelper::getValorMonetarioFormat(old('nf_valorimposto', $notaFiscal->nf_valorimposto ?? null)), 
                                'attr' => ['class' => 'form-control', 'id' => 'nf_valorimposto','disabled']])
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



