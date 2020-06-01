@extends('temps.login')
@section('title', trans('titles.forgotPasswordTitle'))


@section('conteudo-view')
<div class="splash-container text-center">
    <div class="card ">
        <div class="card-body text-center">
            <div class="row">
                <div class="col-12 text-center">
                    <a class="navbar-brand" href="http://sistema-estoque.loc">Fat <span>Sistema de Estoque</span></a>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-12">
                    <h5 class="title-h4">@lang('titles.changePasswordTitle')</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @include('temps.forms.message')
                    <hr/>
                    {!! Form::open(['action' => array('Auth\ResetPasswordController@resetPasswordPost',$token), 'method' => 'post', 'id' => 'form-login', 'class' => 'needs-validation', 'novalidate']) !!}
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input name="password" class="form-control validate" id="password" type="password" placeholder="@lang('label.Password')" value="{{ old('password') }}" required/>
                                    <div class="invalid-feedback">
                                        @lang('label.prencherCampo')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input name="passwordCheck" class="form-control validate" id="passwordCheck" type="password" placeholder="@lang('label.PasswordCheck')" value="{{ old('passwordCheck') }}" required/>
                                    <div class="invalid-feedback">
                                        @lang('label.prencherCampo')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                {!! Form::submit(trans('button.changePassword'),  ['class' => 'btn btn-purple']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <hr/>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ action('Auth\LoginController@login') }}" class="link">@lang('button.goLogin')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection