@extends('temps.master')
@section('title', trans('compra.title'))
@section('title-icone', 'fas fa-dolly')

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
                <h4 class="card-title">@lang('compra.subTitleCadastrar')</h4>
                <a href="{{ URL::previous() }}" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-angle-left"></i> @lang('botao.Voltar')
                </a>
            </div>
            <div class="card-body">
                {!! Form::open(['action' => array('CompraController@updatePost',$compra->com_codigo), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
                    {!! Form::hidden('com_codigo',$compra->com_codigo) !!}
                    <div class="row">
                        <div class="col-12 col-md-3">
                            @include('temps.forms.select',[
                                'input' => 'for_codigo',
                                'label' => trans('label.Fornecedor'), 
                                'value' => old('for_codigo',$compra->for_codigo ?? null), 
                                'list' => $fornecedores, 
                                'attr' => ['placeholder' => trans('global.selecione'),'class' => 'form-control', 'id' => 'for_codigo','required']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.select',[
                                'input' => 'tpg_codigo',
                                'label' => trans('label.TipoPagto'), 
                                'value' => old('tpg_codigo',$compra->tpg_codigo ?? null), 
                                'list' => $tiposPagtos, 
                                'attr' => ['placeholder' => trans('global.selecione'),'class' => 'form-control', 'id' => 'tpg_codigo','required']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.inputDate',[
                                'input' => 'com_datacompra', 
                                'label' => trans('label.DataCompra'), 
                                'value' => old('com_datacompra',$compra->com_datacompra ?? null), 
                                'attr' => ['class' => 'form-control', 'id' => 'com_datacompra','required']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.select',[
                                        'input' => 'com_status',
                                        'label' => trans('label.Status'), 
                                        'value' => old('com_status',$compra->com_status ?? null) , 
                                        'list' => $enumStatus, 
                                        'attr' => ['placeholder' => trans('global.selecione'),'class' => 'form-control', 'id' => 'com_status','required']])
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            @include('temps.forms.textarea',[
                                        'input' => 'com_observacoes', 
                                        'label' => trans('label.Observacoes'), 
                                        'value' => old('com_observacoes',$compra->com_observacoes ?? null), 
                                        'attr' => ['class' => 'form-control', 'id' => 'com_observacoes','required']])
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



