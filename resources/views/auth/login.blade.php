@extends('temps.login')
@section('title', trans('passwords.loginTitle'))


@section('conteudo-view')
<div class="splash-container">
    <div class="card ">
        <div class="card-body">
            <div class="row">
                <div class="col-12 text-center">
                    <a class="navbar-brand" href="http://sistema-estoque.loc">Fat <span>Sistema de Estoque</span></a>
                </div>
            </div>
            <hr/>
            <div class="row text-center">
                <div class="col-12">
                    @include('temps.forms.message')

                    {!! Form::open(['action' => array('Auth\LoginController@loginPost'), 'method' => 'post', 'id' => 'form-login', 'class' => 'needs-validation', 'novalidate']) !!}
                        <div class="form-group">
                            <input name="email" class="form-control validate" id="email" type="email" placeholder="@lang('label.Email')" required/>
                            <div class="invalid-feedback">
                                @lang('global.prencherCampoEmail')
                            </div>
                        </div>
                        <div class="form-group">
                            <input name="password" class="form-control validate" id="password" type="password" placeholder="@lang('label.Password')" required/>
                            <div class="invalid-feedback">
                                @lang('global.prencherCampo')
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                {!! Form::submit(trans('button.login'),  ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <hr/>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ action('Auth\ForgotPasswordController@forgotPassword') }}" class="link">@lang('button.forgotPassword')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection