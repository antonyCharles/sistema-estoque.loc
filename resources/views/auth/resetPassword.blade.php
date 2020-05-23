@extends('layout.public')
@section('title', trans('titles.forgotPasswordTitle'))


@section('content-view')
<section class="banner banner-page">
    <div class="grid">
        <div class="row">
            <div class="cl-12">
                <h3 class="title-h4">@lang('titles.changePasswordTitle')</h3>
            </div>
        </div>
        <div class="row">
            <div class="cl-12">
                @include('layout.forms.message')

                {!! Form::open(['action' => array('Auth\ResetPasswordController@resetPasswordPost',$token), 'method' => 'post', 'id' => 'form-login', 'class' => 'form', 'novalidate']) !!}
                    <div class="row">
                        <div class="cl-12">
                            <div class="form-group">
                                <input name="password" class="validate" id="password" type="password" placeholder="@lang('label.password')" value="{{ old('password') }}" required/>
                                <div class="error">
                                    @lang('label.fillInput')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="cl-12">
                            <div class="form-group">
                                <input name="passwordCheck" class="validate" id="passwordCheck" type="password" placeholder="@lang('label.passwordCheck')" value="{{ old('passwordCheck') }}" required/>
                                <div class="error">
                                    @lang('label.fillInput')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="cl-12">
                            {!! Form::submit(trans('button.changePassword'),  ['class' => 'btn btn-purple']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
                <div class="row">
                    <div class="cl-12">
                        <a href="{{ action('Auth\LoginController@login') }}" class="link">@lang('button.goLogin')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="block bk-1 bg-blue"></div>
    <div class="block bk-2 bg-white"></div>
    <div class="block bk-3 bg-purple"></div>
    <div class="block bk-4 bg-white"></div>
    <div class="block bk-5 bg-red"></div>

    <div class="block bk-6 bg-red"></div>
    <div class="block bk-7 bg-white"></div>
    <div class="block bk-8 bg-blue"></div>
    <div class="block bk-9 bg-white"></div>
    <div class="block bk-10 bg-purple"></div>

</section>
@endsection