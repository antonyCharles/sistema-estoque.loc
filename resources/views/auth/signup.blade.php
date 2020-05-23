@extends('layout.public')
@section('title', trans('titles.signUpTitle'))


@section('content-view')
<section class="banner banner-page">
    <div class="grid">
        <div class="row">
            <div class="cl-12">
                <h3 class="title-h4">@lang('titles.signUpTitle')</h3>
            </div>
        </div>
        <div class="row">
            <div class="cl-12">
                @include('layout.forms.message')

                {!! Form::open(['action' => array('Auth\RegisterController@createPost'), 'method' => 'post', 'id' => 'form-login', 'class' => 'form', 'novalidate']) !!}
                    <div class="form-group">
                        <input name="name" class="validate" id="name" type="text" placeholder="@lang('label.name')" value="{{ old('name') }}" required/>
                        <div class="error">
                            @lang('label.fillInput')
                        </div>
                    </div>
                    <div class="row">
                        <div class="cl-12 cl-m-6">
                            <div class="form-group">
                                <input name="email" class="validate" id="email" type="email" placeholder="@lang('label.email')" value="{{ old('email') }}" required/>
                                <div class="error">
                                    @lang('label.fillInputEmail')
                                </div>
                            </div>
                        </div>
                        <div class="cl-12 cl-m-6">
                            <div class="form-group">
                                <input name="emailCheck" class="validate" id="emailCheck" type="emailCheck" placeholder="@lang('label.emailCheck')" value="{{ old('emailCheck') }}" autocomplete="off" required/>
                                <div class="error">
                                    @lang('label.fillInputEmail')
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <input name="password" class="validate" id="password" type="password" placeholder="@lang('label.password')" value="{{ old('password') }}" required/>
                        <div class="error">
                            @lang('label.fillInput')
                        </div>
                    </div>
                    <div class="row">
                        <div class="cl-12">
                            {!! Form::submit(trans('button.signUp'),  ['class' => 'btn btn-red']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
                <div class="row">
                    <div class="cl-12">
                        <a href="{{ action('Auth\ForgotPasswordController@forgotPassword') }}" class="link">@lang('button.forgotPassword')</a>
                    </div>
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