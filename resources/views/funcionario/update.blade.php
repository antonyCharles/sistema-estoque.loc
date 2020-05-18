@extends('temps.master')
@section('title', trans('funcionario.title'))

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
            <h2 class="pageheader-title  d-inline-block"><i class="fas fa-users"></i> @lang('funcionario.title')</h2>
        </div>
    </div>
</div>

@include('temps.forms.message')

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('funcionario.subTitleAlterar')</h4>
                <a href="javascript:history.back()" class="btn btn-outline-light btn-sm"><i class="fas fa-angle-left"></i> @lang('botao.Voltar')</a>
            </div>
            <div class="card-body">
                {!! Form::open(['action' => array('FuncionarioController@updatePost',$funcionario->fun_codigo), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
                    {!! Form::hidden('fun_codigo',$funcionario->fun_codigo) !!}
                    <div class="row">
                        <div class="col-12 col-md-3">
                            @include('temps.forms.input',[
                                'input' => 'fun_nome', 
                                'label' => trans('label.Nome'), 
                                'value' => old('fun_nome',$funcionario->fun_nome ?? null), 
                                'attr' => ['class' => 'form-control', 'id' => 'fun_nome','required']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.input',[
                                'input' => 'fun_cnpjcpf', 
                                'label' => trans('label.CnpjCpf'), 
                                'value' => old('fun_cnpjcpf',$funcionario->fun_cnpjcpf ?? null), 
                                'attr' => ['class' => 'form-control', 'id' => 'fun_cnpjcpf','required']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.input',[
                                'input' => 'fun_email', 
                                'label' => trans('label.Email'), 
                                'value' => old('fun_email',$funcionario->fun_email ?? null), 
                                'attr' => ['class' => 'form-control', 'id' => 'fun_email','required']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.input',[
                                'input' => 'fun_rgie', 
                                'label' => trans('label.Rgie'), 
                                'value' => old('fun_rgie',$funcionario->fun_rgie ?? null), 
                                'attr' => ['class' => 'form-control', 'id' => 'fun_rgie','required']])
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-12 col-md-3">
                            @include('temps.forms.inputDate',[
                                'input' => 'fun_nascimento', 
                                'label' => trans('label.DtNascimento'), 
                                'value' => old('fun_nascimento',$funcionario->fun_nascimento ?? null), 
                                'attr' => ['class' => 'form-control', 'id' => 'fun_nascimento','required']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.select',[
                                'input' => 'fun_sexo',
                                'label' => trans('label.Sexo'), 
                                'value' => old('fun_sexo',$funcionario->fun_sexo ?? null), 
                                'list' => $enumSexo, 
                                'attr' => ['placeholder' => trans('global.selecione'),'class' => 'form-control', 'id' => 'fun_sexo','required']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.input',[
                                'input' => 'fun_telefone', 
                                'label' => trans('label.Telefone'), 
                                'value' => old('fun_telefone',$funcionario->fun_telefone ?? null), 
                                'attr' => ['class' => 'form-control', 'id' => 'fun_telefone']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.input',[
                                'input' => 'fun_celular', 
                                'label' => trans('label.Celular'), 
                                'value' => old('fun_celular',$funcionario->fun_celular ?? null), 
                                'attr' => ['class' => 'form-control', 'id' => 'fun_celular']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.input',[
                                'input' => 'fun_salario', 
                                'label' => trans('label.Salario'), 
                                'value' => ViewHelper::getValorMonetarioFormat(old('fun_salario',$funcionario->fun_salario ?? null)), 
                                'attr' => ['class' => 'form-control valor-monetario', 'id' => 'fun_salario','required']])
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12 col-md-5">
                            @include('temps.forms.input',[
                                'input' => 'fun_endereco', 
                                'label' => trans('label.Endereco'), 
                                'value' => old('fun_endereco',$funcionario->fun_endereco ?? null), 
                                'attr' => ['class' => 'form-control', 'id' => 'fun_endereco','required']])
                        </div>
                        <div class="col-12 col-md-2">
                            @include('temps.forms.input',[
                                'input' => 'fun_numero', 
                                'label' => trans('label.Numero'), 
                                'value' => old('fun_numero',$funcionario->fun_numero ?? null), 
                                'attr' => ['class' => 'form-control', 'id' => 'fun_numero','required']])
                        </div>
                        <div class="col-12 col-md-5">
                            @include('temps.forms.input',[
                                'input' => 'fun_complemento', 
                                'label' => trans('label.Complemento'), 
                                'value' => old('fun_complemento',$funcionario->fun_complemento ?? null), 
                                'attr' => ['class' => 'form-control', 'id' => 'fun_complemento']])
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-12 col-md-5">
                            @include('temps.forms.input',[
                                'input' => 'fun_bairro', 
                                'label' => trans('label.Bairro'), 
                                'value' => old('fun_bairro',$funcionario->fun_bairro ?? null), 
                                'attr' => ['class' => 'form-control', 'id' => 'fun_bairro','required']])
                        </div>
                        <div class="col-12 col-md-5">
                            @include('temps.forms.input',[
                                'input' => 'fun_cidade', 
                                'label' => trans('label.Cidade'), 
                                'value' => old('fun_cidade',$funcionario->fun_cidade ?? null), 
                                'attr' => ['class' => 'form-control', 'id' => 'fun_cidade','required']])
                        </div>
                        <div class="col-12 col-md-2">
                            @include('temps.forms.input',[
                                'input' => 'fun_uf', 
                                'label' => trans('label.Uf'), 
                                'value' => old('fun_uf',$funcionario->fun_uf ?? null), 
                                'attr' => ['class' => 'form-control', 'id' => 'fun_uf','required']])
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



