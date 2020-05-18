@extends('temps.master')
@section('title', trans('usuario.titleEditarUsuario'))

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
            <h2 class="pageheader-title  d-inline-block"><i class="fas fa-user"></i> @lang('usuario.titleEditarUsuario')</h2>
        </div>
    </div>
</div>

@include('temps.forms.messageRequest')

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">@lang('usuario.msgEditarUsuario')</h5>
            <div class="card-body">
                {!! Form::open(['action' => array('UsuarioController@EditPost',$Usuario->id ?? null), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
                    @include('temps.forms.inputhidden',['input' => 'id', 'value' => $Usuario->id])
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            @include('temps.forms.input',['input' => 'name', 'label' => trans('label.Nome'), 'value' => old('name', $Usuario->name ?? null) , 'attr' => ['class' => 'form-control', 'id' => 'name', 'required']])
                        </div>
                        <div class="col-12 col-sm-4">
                            @include('temps.forms.input',['input' => 'email', 'label' => trans('label.Email'), 'value' => old('email', $Usuario->email ?? null) , 'attr' => ['class' => 'form-control', 'id' => 'email', 'required']])
                        </div>
                        <div class="col-12 col-sm-4">
                            @include('temps.forms.select',['input' => 'status','label' => trans('label.Status'), 'value' => old('status', $Usuario->status ?? null) , 'list' => $listStatus, 'attr' => ['placeholder' => trans('global.selecione'),'class' => 'form-control', 'id' => 'status', 'required']])
                        </div>
                        <div class="col-12 col-sm-4">
                            @include('temps.forms.select',['input' => 'perfilId','label' => trans('label.Perfil'), 'value' => old('perfilId', $Usuario->perfil_id ?? null) , 'list' => $PerfisSelect, 'attr' => ['placeholder' => trans('global.selecione'),'class' => 'form-control', 'id' => 'perfilId', 'required']])
                        </div>
                    </div>
                    <div class="row t-2">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                            @include('temps.forms.submit',['input' => trans('botao.Alterar'), 'attr' => ['class' => 'btn btn-success']])
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection