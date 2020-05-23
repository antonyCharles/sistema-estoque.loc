@extends('temps.master')
@section('title', trans('tipoPagto.title'))
@section('title-icone', 'fas fa-clipboard-list')

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
                <h4 class="card-title">@lang('tipoPagto.subTitleAlterar')</h4>
                <a href="{{ URL::previous() }}" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-angle-left"></i> @lang('botao.Voltar')
                </a>
            </div>
            <div class="card-body">
                {!! Form::open(['action' => array('TipoPagtoController@updatePost',$tipoPagto->tpg_codigo), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
                    {!! Form::hidden('tpg_codigo',$tipoPagto->tpg_codigo) !!}
                    <div class="row">
                    <div class="col-12 col-md-4">
                            @include('temps.forms.input',[
                                        'input' => 'tpg_descricao', 
                                        'label' => trans('label.Descricao'), 
                                        'value' => old('tpg_descricao',$tipoPagto->tpg_descricao ?? null), 
                                        'attr' => ['class' => 'form-control', 'id' => 'tpg_descricao','required']])
                        </div>
                        <div class="col-12 col-md-4">
                            @include('temps.forms.input',[
                                        'input' => 'tpg_qtde', 
                                        'label' => trans('label.Qtde'), 
                                        'value' => old('tpg_qtde',$tipoPagto->tpg_qtde ?? null), 
                                        'attr' => ['class' => 'form-control', 'id' => 'tpg_qtde','required']])
                        </div>
                        <div class="col-12 col-md-4">
                            @include('temps.forms.select',[
                                        'input' => 'tpg_ativo',
                                        'label' => trans('label.Ativo'), 
                                        'value' => old('tpg_ativo',$tipoPagto->tpg_ativo ?? null), 
                                        'list' => $enumSimNao, 
                                        'attr' => ['placeholder' => trans('global.selecione'),'class' => 'form-control', 'id' => 'tpg_ativo','required']])
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



