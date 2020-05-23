@extends('temps.master')
@section('title', trans('venda.title'))
@section('title-icone', 'fas fa-shopping-cart')

@section('css-view')
<style>
    table .form-group{
        margin-bottom: 0px;
    }
    .box-lista-produtos{
        border: 1px solid #4952A2;
        padding: 10px 0px;
        margin: 0px 0px;
        border-radius: 5px;
    }
</style>
@endsection

@section('js-view')
<script src="{{ asset('vendor/parsley/parsley.js') }}"></script>
<script src="{{ asset('libs/js/ativa-mensagem-validador-form.js') }}"></script>
<script src="{{ asset('libs/js/lista-produtos.js') }}"></script>
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
                {!! Form::open(['action' => array('VendaController@createPost'), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
                    <div class="row">
                        <div class="col-12 col-md-3">
                            @include('temps.forms.select',[
                                'input' => 'fun_codigo',
                                'label' => trans('label.Funcionario'), 
                                'value' => old('fun_codigo'), 
                                'list' => $funcionarios, 
                                'attr' => ['placeholder' => trans('global.selecione'),'class' => 'form-control', 'id' => 'fun_codigo','required']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.select',[
                                'input' => 'tpg_codigo',
                                'label' => trans('label.TipoPagto'), 
                                'value' => old('tpg_codigo') , 
                                'list' => $tiposPagtos, 
                                'attr' => ['placeholder' => trans('global.selecione'),'class' => 'form-control', 'id' => 'tpg_codigo','required']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.inputDate',[
                                'input' => 'ven_datavenda', 
                                'label' => trans('label.DataVenda'), 
                                'value' => old('ven_datavenda', date('Y-m-d')) , 
                                'attr' => ['class' => 'form-control', 'id' => 'ven_datavenda','required']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.select',[
                                        'input' => 'ven_status',
                                        'label' => trans('label.Status'), 
                                        'value' => old('ven_status') , 
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
                                        'value' => old('ven_observacoes') , 
                                        'attr' => ['class' => 'form-control', 'id' => 'ven_observacoes','required']])
                        </div>
                    </div>
                    <br/>
                    <div class="row box-lista-produtos">
                        <div class="col-12">
                            <h3 class="font-16">@lang('venda.subListaProdutos')</h3>
                        </div>
                        <div class="col-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">@lang('label.Produto')</th>
                                        <th scope="col">@lang('label.Qtde')</th>
                                        <th scope="col">@lang('label.Desconto')</th>
                                        <th scope="col">@lang('label.PrecoUnitario')</th>
                                        <th scope="col">@lang('label.ValorTotal')</th>
                                        <th class="text-right">
                                            <button type="button" id="add-item-lista" class="btn btn-success btn-sm">
                                                <i class="fas fa-plus"></i> @lang('label.Produto')
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="lista-produtos">
                                <?php
                                    $pro_codigo = old('pro_codigo');
                                    $ven_quantidade = old('ven_quantidade');
                                    $ven_desconto = old('ven_desconto');
                                    $valorTotalTotal = 0;
                                ?>
                                @if($pro_codigo != null)
                                    @for($i = 0; $i < count($pro_codigo);$i++)
                                        <tr>
                                            <td style="width: 50%">
                                                <div class="form-group">
                                                    <select class="form-control sel-lista-produtos" required="" name="pro_codigo[]">
                                                        <option value="">Selecione...</option>
                                                        @foreach($produtos as $k)
                                                            <option value="{{ $k->pro_codigo }}" <?= $pro_codigo[$i] == $k->pro_codigo ? 'selected' : ''; ?>  data-precovenda="{{ ViewHelper::getValorMonetarioFormat($k->pro_precocusto) }}">{{ $k->pro_descricao }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        @lang('global.selecioneItem')
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="width: 10%">
                                                <div class="form-group">
                                                    <input class="form-control inp-quantidade" required="" min="1" name="ven_quantidade[]" type="number" value="{{ $ven_quantidade[$i] }}">
                                                    <div class="invalid-feedback">
                                                        @lang('global.prencherCampo')
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="width: 10%">
                                                <div class="form-group">
                                                    <input class="form-control inp-desconto valor-monetario" name="ven_desconto[]" type="text" value="{{ $ven_desconto[$i] }}" required=""/>
                                                    <div class="invalid-feedback">
                                                        @lang('global.prencherCampo')
                                                    </div>
                                                </div>
                                                <?php 
                                                    $prodAtual = $produtos->find($pro_codigo[$i]); 
                                                    $valorTotal = ($prodAtual->pro_precocusto * $ven_quantidade[$i]) - ViewHelper::converterInNumber($ven_desconto[$i]);
                                                    $valorTotalTotal += ($valorTotal >= 0 ? $valorTotal : 0);
                                                ?>
                                            </td>
                                            <td class="td-preco-unico">R$ {{ ViewHelper::getValorMonetarioFormat($prodAtual->pro_precocusto) }}</td>
                                            <td class="td-valor-total" data-valor-total="{{ $valorTotal }}" >R$ {{ ViewHelper::getValorMonetarioFormat(($valorTotal >= 0 ? $valorTotal : '0.00')) }}</td>
                                            <td class="text-right">
                                                <button type="button" class="btn btn-danger btn-sm remove-item-lista">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endfor
                                @endif
                                </tbody>
                                <tfoot>
                                    <tr class="table-secondary">
                                        <th class="text-right lead" colspan="4">@lang('label.ValorTotal')</th>
                                        <th class="text-center lead" colspan="2">R$ {{ $valorTotalTotal > 0 ? ViewHelper::getValorMonetarioFormat($valorTotalTotal) : '0,00' }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <br/>
                    <br/>
                    <div class="row">
                        <div class="col-12">
                            <h3 class="font-16">@lang('notaFiscal.title'):</h3>
                            <hr/>
                        </div>
                        <div class="col-12 col-md-6">
                            <br/>
                            <label class="custom-control custom-checkbox">
                                {{ Form::checkbox(
                                    'ven_criar_notafiscal', 
                                    'S', 
                                    old('ven_criar_notafiscal') && old('ven_criar_notafiscal') != 'S' ? false : true,
                                    ['class' => 'custom-control-input create-nota-fiscal']) 
                                }}
                                <span class="custom-control-label">@lang('venda.criarNotaFiscal')</span>
                            </label>
                        </div>
                        <div class="col-12 col-md-6 select-nota-fiscal">
                            @include('temps.forms.select',[
                                'input' => 'nf_codigo',
                                'label' => trans('label.NotaFiscal'), 
                                'value' => old('nf_codigo') , 
                                'list' => $notasfiscais, 
                                'attr' => ['placeholder' => trans('global.selecione'),'class' => 'form-control', 'id' => 'nf_codigo']])
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
<template id="temp-item-produto-lista">
    <tr>
        <td style="width: 50%">
            <div class="form-group">
                <select class="form-control sel-lista-produtos" required="" name="pro_codigo[]">
                    <option value="">Selecione...</option>
                    @foreach($produtos as $k)
                        <option value="{{ $k->pro_codigo }}" data-precovenda="{{ ViewHelper::getValorMonetarioFormat($k->pro_precocusto) }}">{{ $k->pro_descricao }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    @lang('global.selecioneItem')
                </div>
            </div>
        </td>
        <td style="width: 10%">
            <div class="form-group">
                <input class="form-control  inp-quantidade" required="" min="1" name="ven_quantidade[]" type="number" value="1">
                <div class="invalid-feedback">
                    @lang('global.prencherCampo')
                </div>
            </div>
        </td>
        <td style="width: 10%">
            <div class="form-group">
                <input class="form-control inp-desconto valor-monetario" name="ven_desconto[]" type="text" value="0,00" required=""/>
                <div class="invalid-feedback">
                    @lang('global.prencherCampo')
                </div>
            </div>
        </td>
        <td class="td-preco-unico">-----</td>
        <td class="td-valor-total">-----</td>
        <td class="text-right">
            <button type="button" class="btn btn-danger btn-sm remove-item-lista">
                <i class="far fa-trash-alt"></i>
            </button>
        </td>
    </tr>
</template>
@endsection



