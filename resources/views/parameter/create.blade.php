@extends('temps.master')
@section('title', trans('titles.parametersTitle'))
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
        <h4 class="card-title">@lang('titles.create')</h4>
        <a href="{{ URL::previous() }}" class="btn btn-outline-light btn-sm">
            <i class="fas fa-angle-left"></i> @lang('botao.Voltar')
        </a>
    </div>
    <div class="card-body">
        {!! Form::open(['action' => array('ParameterController@createPost'), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
            <div class="row">
                <div class="col-12 col-md-3">
                    @include('temps.forms.input',[
                        'input' => 'label', 
                        'label' => trans('label.label'), 
                        'value' => old('label') , 
                        'attr' => ['class' => 'form-control', 'id' => 'label','required']])
                </div>
                <div class="col-12 col-md-3">
                    @include('temps.forms.select',[
                        'input' => 'group_parameter_id',
                        'label' => trans('label.groupParameter'), 
                        'value' => old('group_parameter_id'), 
                        'list' => $groupsParameter, 
                        'attr' => ['placeholder' => trans('label.select'),'class' => 'form-control', 'id' => 'group_parameter_id','required']])
                </div>
                <div class="col-12 col-md-3">
                    @include('temps.forms.select',[
                        'input' => 'type_parameter',
                        'label' => trans('label.typeParameter'), 
                        'value' => old('type_parameter'), 
                        'list' => EnumHelper::getEnum('TypesParameterEnum'), 
                        'attr' => ['placeholder' => trans('label.select'),'class' => 'form-control', 'id' => 'type_parameter','required']])
                </div>
                <div class="col-12 col-md-3">
                    @include('temps.forms.select',[
                        'input' => 'status',
                        'label' => trans('label.status'), 
                        'value' => old('status'), 
                        'list' => EnumHelper::getEnum('StatusEnum'), 
                        'attr' => ['placeholder' => trans('label.select'),'class' => 'form-control', 'id' => 'status','required']])
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12">
                    @include('temps.forms.textarea',[
                                'input' => 'values_select', 
                                'label' => trans('label.valuesSelect'), 
                                'value' => old('values_select') , 
                                'attr' => ['class' => 'form-control', 'id' => 'values_select', 'rows' => '5']])
                </div>
            </div>
            <br/>
            <div class="row t-2">
                <div class="col-12 text-right">
                    {!! Form::submit(trans('button.create'),  ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection