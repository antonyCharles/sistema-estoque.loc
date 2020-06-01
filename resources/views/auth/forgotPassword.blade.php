@extends('temps.login')
@section('title', trans('titles.forgotPasswordTitle'))


@section('conteudo-view')
<div class="splash-container">
    <div class="card ">
        <div class="card-body text-center">
            <div class="row">
                <div class="col-12 text-center">
                    <a class="navbar-brand" href="http://sistema-estoque.loc">Fat <span>Sistema de Estoque</span></a>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="cl-12">
                    <h5 class="title-h4">@lang('titles.forgotPasswordTitle')</h5>
                    <p>@lang('message.resetPassword')</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @include('temps.forms.message')
                    <hr/>
                    {!! Form::open(['action' => array('Auth\ForgotPasswordController@forgotPasswordPost'), 'method' => 'post', 'id' => 'form-login', 'class' => 'needs-validation', 'novalidate']) !!}
                        <div class="form-group">
                            <input name="email" class="form-control validate" id="email" type="email" placeholder="@lang('label.Email')" required/>
                            <div class="invalid-feedback">
                                @lang('global.prencherCampoEmail')
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                {!! Form::submit(trans('button.resetPassword'),  ['class' => 'btn btn-primary']) !!}
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