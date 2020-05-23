@extends('temps.master')
@section('title', trans('titles.groupsParametersTitle'))
@section('title-icone', 'fas fa-cog')


@section('css-view')

@endsection
@section('js-view')
    <script src="{{ asset('js/plugins/parsley.js') }}"></script>
    <script src="{{ asset('js/validation-form.js') }}"></script>
@endsection

@section('conteudo-view')
<div class="main-card mb-3 card">
    <div class="card-header d-flex justify-content-between bd-highlight">
        <h6 class="font-weight-bold">@lang('titles.update')</h6>
        <div class="float-left">
            <a href="{{ URL::previous() }}" class="btn btn-outline-light btn-sm">
                <i class="fas fa-angle-left"></i> @lang('botao.Voltar')
            </a>
        </div>
    </div>
    <div class="card-body">
        {!! Form::open(['action' => array('GroupParameterController@updatePost',$groupParameter->group_parameter_id), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
            {!! Form::hidden('group_parameter_id',$groupParameter->group_parameter_id) !!}
            <div class="row">
                <div class="col-12 col-md-6">
                    @include('temps.forms.input',[
                        'input' => 'name', 
                        'label' => trans('label.name'), 
                        'value' => old('name', $groupParameter->name ?? null), 
                        'attr' => ['class' => 'form-control', 'id' => 'name','required']])
                </div>
                <div class="col-12 col-md-6">
                    @include('temps.forms.select',[
                        'input' => 'status',
                        'label' => trans('label.status'), 
                        'value' => old('status', $groupParameter->status ?? null), 
                        'list' => EnumHelper::getEnum('StatusEnum'), 
                        'attr' => ['placeholder' => trans('label.select'),'class' => 'form-control', 'id' => 'status','required']])
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