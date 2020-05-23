@extends('temps.master')
@section('title', trans('venda.title'))
@section('title-icone', 'fas fa-shopping-cart')

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
                <h4 class="card-title">@lang('venda.subTitleCadastrar')</h4>
                <a href="{{ URL::previous() }}" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-angle-left"></i> @lang('botao.Voltar')
                </a>
            </div>
            <div class="card-body">
                {!! Form::open(['action' => array('VendaController@updatePost',$venda->ven_codigo), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
                    {!! Form::hidden('ven_codigo',$venda->ven_codigo) !!}
                    <div class="row">
                        <div class="col-12 col-md-3">
                            @include('temps.forms.select',[
                                'input' => 'fun_codigo',
                                'label' => trans('label.Funcionario'), 
                                'value' => old('fun_codigo', $venda->fun_codigo ?? null), 
                                'list' => $funcionarios, 
                                'attr' => ['placeholder' => trans('global.selecione'),'class' => 'form-control', 'id' => 'fun_codigo','required']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.select',[
                                'input' => 'tpg_codigo',
                                'label' => trans('label.TipoPagto'), 
                                'value' => old('tpg_codigo', $venda->tpg_codigo ?? null) , 
                                'list' => $tiposPagtos, 
                                'attr' => ['placeholder' => trans('global.selecione'),'class' => 'form-control', 'id' => 'tpg_codigo','required']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.inputDate',[
                                'input' => 'ven_datavenda', 
                                'label' => trans('label.DataVenda'), 
                                'value' => old('ven_datavenda', $venda->ven_datavenda ?? null) , 
                                'attr' => ['class' => 'form-control', 'id' => 'ven_datavenda','required']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.select',[
                                        'input' => 'ven_status',
                                        'label' => trans('label.Status'), 
                                        'value' => old('ven_status', $venda->ven_status ?? null) , 
                                        'list' => $enumStatus, 
                                        'attr' => ['placeholder' => trans('global.selecione'),'class' => 'form-control', 'id' => 'ven_status','required']])
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            @include('temps.forms.textarea',[
                                        'input' => 'ven_observacoes', 
                                        'label' => trans('label.Observacoes'), 
                                        'value' => old('ven_observacoes', $venda->ven_observacoes ?? null) , 
                                        'attr' => ['class' => 'form-control', 'id' => 'ven_observacoes','required']])
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



