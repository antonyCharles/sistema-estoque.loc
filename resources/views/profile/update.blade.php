@extends('temps.master')
@section('title', trans('titles.profilesTitle'))
@section('title-icone', 'fas fa-cog')

@section('css-view')

@endsection
@section('js-view')
<script src="{{ asset('js/plugins/parsley.js') }}"></script>
<script src="{{ asset('js/validation-form.js') }}"></script>
@endsection

@section('conteudo-view')
<div class="main-card mb-3 card">
    <div class="card-header">
        <h4 class="card-title">@lang('titles.update')</h4>
        <a href="{{ URL::previous() }}" class="btn btn-outline-light btn-sm">
            <i class="fas fa-angle-left"></i> @lang('botao.Voltar')
        </a>
    </div>
    <div class="card-body">
        {!! Form::open(['action' => array('ProfileController@updatePost',$profile->profile_id), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
            {!! Form::hidden('profile_id',$profile->profile_id) !!}
            <div class="row">
                <div class="col-12 col-md-6">
                    @include('temps.forms.input',[
                        'input' => 'name', 
                        'label' => trans('label.name'), 
                        'value' => old('name', $profile->name ?? null) , 
                        'attr' => ['class' => 'form-control', 'id' => 'name','required']])
                </div>
                <div class="col-12 col-md-6">
                    @include('temps.forms.select',[
                        'input' => 'status',
                        'label' => trans('label.status'), 
                        'value' => old('status', $profile->status ?? null), 
                        'list' => EnumHelper::getEnum('StatusEnum'), 
                        'attr' => ['placeholder' => trans('label.select'),'class' => 'form-control', 'id' => 'status','required']])
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12">
                    @include('temps.forms.textarea',[
                                'input' => 'description', 
                                'label' => trans('label.description'), 
                                'value' => old('description', $profile->description ?? null) , 
                                'attr' => ['class' => 'form-control', 'id' => 'description', 'rows' => '5']])
                </div>
            </div>
            <br/>
            <div class="row t-2">
                <div class="col-12 text-right">
                    {!! Form::submit(trans('button.update'),  ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection