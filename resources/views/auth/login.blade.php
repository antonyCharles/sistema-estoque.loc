@extends('temps.login')
@section('title', trans('passwords.loginTitle'))


@section('conteudo-view')
<div class="splash-container">
    <div class="card ">
        <div class="card-body">
            <div class="row">
                <div class="cl-12">
                    <h3 class="title-h4">@lang('home.tLogin')</h3>
                </div>
            </div>
            <div class="row">
                <div class="cl-12">
                    @include('temps.forms.message')

                    {!! Form::open(['action' => array('Auth\LoginController@loginPost'), 'method' => 'post', 'id' => 'form-login', 'class' => 'form', 'novalidate']) !!}
                        <div class="form-group">
                            <input name="email" class="validate" id="email" type="email" placeholder="@lang('label.email')" required/>
                            <div class="error">
                                @lang('label.fillInputEmail')
                            </div>
                        </div>
                        <div class="form-group">
                            <input name="password" class="validate" id="password" type="password" placeholder="@lang('label.password')" required/>
                            <div class="error">
                                @lang('label.fillInput')
                            </div>
                        </div>
                        <div class="row">
                            <div class="cl-12">
                                {!! Form::submit(trans('button.login'),  ['class' => 'btn btn-info']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <div class="row">
                        <div class="cl-12">
                            <a href="{{ action('Auth\ForgotPasswordController@forgotPassword') }}" class="link">@lang('button.forgotPassword')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection