@extends('temps.master')
@section('title', trans('fornecedor.title'))
@section('title-icone', 'fas fa-building')

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
                <h4 class="card-title">@lang('fornecedor.subTitleAlterar')</h4>
                <a href="{{ URL::previous() }}" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-angle-left"></i> @lang('botao.Voltar')
                </a>
            </div>
            <div class="card-body">
                {!! Form::open(['action' => array('FornecedorController@updatePost',$fornecedor->for_codigo), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
                    {!! Form::hidden('for_codigo',$fornecedor->for_codigo) !!}
                    <div class="row">
                        <div class="col-12 col-md-4">
                            @include('temps.forms.input',[
                                'input' => 'for_nome', 
                                'label' => trans('label.Nome'), 
                                'value' => old('for_nome',$fornecedor->for_nome ?? null) , 
                                'attr' => ['class' => 'form-control', 'id' => 'for_nome','required']])
                        </div>
                        <div class="col-12 col-md-4">
                            @include('temps.forms.input',[
                                'input' => 'for_cnpjcpf', 
                                'label' => trans('label.CnpjCpf'), 
                                'value' => old('for_cnpjcpf',$fornecedor->for_cnpjcpf ?? null) , 
                                'attr' => ['class' => 'form-control', 'id' => 'for_cnpjcpf','required']])
                        </div>
                        <div class="col-12 col-md-4">
                            @include('temps.forms.input',[
                                'input' => 'for_rgie', 
                                'label' => trans('label.Rgie'), 
                                'value' => old('for_rgie',$fornecedor->for_rgie ?? null) , 
                                'attr' => ['class' => 'form-control', 'id' => 'for_rgie']])
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-12 col-md-3">
                            @include('temps.forms.input',[
                                'input' => 'for_telefone', 
                                'label' => trans('label.Telefone'), 
                                'value' => old('for_telefone',$fornecedor->for_telefone ?? null) , 
                                'attr' => ['class' => 'form-control', 'id' => 'for_telefone','required']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.input',[
                                'input' => 'for_celular', 
                                'label' => trans('label.Celular'), 
                                'value' => old('for_celular',$fornecedor->for_celular ?? null) , 
                                'attr' => ['class' => 'form-control', 'id' => 'for_celular']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.input',[
                                'input' => 'for_fax', 
                                'label' => trans('label.Fax'), 
                                'value' => old('for_fax',$fornecedor->for_fax ?? null) , 
                                'attr' => ['class' => 'form-control', 'id' => 'for_fax']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.input',[
                                'input' => 'for_email', 
                                'label' => trans('label.Email'), 
                                'value' => old('for_email',$fornecedor->for_email ?? null) , 
                                'attr' => ['class' => 'form-control', 'id' => 'for_email','required']])
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            @include('temps.forms.input',[
                                'input' => 'for_endereco', 
                                'label' => trans('label.Endereco'), 
                                'value' => old('for_endereco',$fornecedor->for_endereco ?? null) , 
                                'attr' => ['class' => 'form-control', 'id' => 'for_endereco','required']])
                        </div>
                        <div class="col-12 col-md-1">
                            @include('temps.forms.input',[
                                'input' => 'for_numero', 
                                'label' => trans('label.Numero'), 
                                'value' => old('for_numero',$fornecedor->for_numero ?? null) , 
                                'attr' => ['class' => 'form-control', 'id' => 'for_numero','required']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.input',[
                                'input' => 'for_bairro', 
                                'label' => trans('label.Bairro'), 
                                'value' => old('for_bairro',$fornecedor->for_bairro ?? null) , 
                                'attr' => ['class' => 'form-control', 'id' => 'for_bairro','required']])
                        </div>
                        <div class="col-12 col-md-3">
                            @include('temps.forms.input',[
                                'input' => 'for_cidade', 
                                'label' => trans('label.Cidade'), 
                                'value' => old('for_cidade',$fornecedor->for_cidade ?? null) , 
                                'attr' => ['class' => 'form-control', 'id' => 'for_cidade','required']])
                        </div>
                        <div class="col-12 col-md-1">
                            @include('temps.forms.input',[
                                'input' => 'for_uf', 
                                'label' => trans('label.Uf'), 
                                'value' => old('for_uf',$fornecedor->for_uf ?? null) , 
                                'attr' => ['class' => 'form-control', 'id' => 'for_uf','required']])
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



