@extends('temps.master')
@section('title', trans('usuario.titleNovoUsuario'))

@section('css-view')

@endsection

@section('js-view')
<script src="{{ asset('vendor/parsley/parsley.js') }}"></script>
<script src="{{ asset('libs/js/ativa-mensagem-validador-form.js') }}"></script>
@endsection

@section('js-code-view')
@endsection

@section('conteudo-view')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header border-bottom">
            <h2 class="pageheader-title  d-inline-block"><i class="fas fa-user"></i> @lang('usuario.titleNovoUsuario')</h2>
        </div>
    </div>
</div>

@include('temps.forms.messageRequest')

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">@lang('usuario.msgNovoUsuario')</h5>
            <div class="card-body">
                {!! Form::open(['action' => array('UsuarioController@CreatePost'), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            @include('temps.forms.input',['input' => 'name', 'label' => trans('label.Nome'), 'value' => old('name') , 'attr' => ['class' => 'form-control', 'id' => 'name', 'required']])
                        </div>
                        <div class="col-12 col-sm-4">
                            @include('temps.forms.input',['input' => 'email', 'label' => trans('label.Email'), 'value' => old('email') , 'attr' => ['class' => 'form-control', 'id' => 'email', 'required']])
                        </div>
                        <div class="col-12 col-sm-4">
                            @include('temps.forms.select',['input' => 'status','label' => trans('label.Status'), 'value' => old('status') , 'list' => $listStatus, 'attr' => ['placeholder' => trans('global.selecione'),'class' => 'form-control', 'id' => 'status', 'required']])
                        </div>
                        <div class="col-12 col-sm-4">
                            @include('temps.forms.select',['input' => 'perfilId','label' => trans('label.Perfil'), 'value' => old('perfilId') , 'list' => $PerfisSelect, 'attr' => ['placeholder' => trans('global.selecione'),'class' => 'form-control', 'id' => 'perfilId', 'required']])
                        </div>
                        <div class="col-12 col-sm-4">
                            @include('temps.forms.password',['input' => 'password', 'label' => trans('label.Senha'), 'value' => old('password') , 'attr' => ['class' => 'form-control', 'id' => 'password', 'required']])
                        </div>
                        <div class="col-12 col-sm-4">
                            @include('temps.forms.password',['input' => 'passwordCheck', 'label' => trans('label.ConfSenha'), 'value' => old('passwordCheck') , 'attr' => ['class' => 'form-control', 'id' => 'passwordCheck', 'required']])
                        </div>
                    </div>
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