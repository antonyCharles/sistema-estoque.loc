@extends('temps.master')
@section('title', trans('titles.parametersTitle'))
@section('title-icone', 'fas fa-cog')


@section('css-view')
@endsection
@section('js-view')
@endsection

@section('conteudo-view')
<div class="main-card mb-3 card">
    <div class="card-header">
        <h4 class="card-title">@lang('titles.delete')</h4>
        <a href="{{ URL::previous() }}" class="btn btn-outline-light btn-sm">
            <i class="fas fa-angle-left"></i> @lang('botao.Voltar')
        </a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-6">
                <table class="table table-bordered">
                    @include('temps.tables.trHorizontal',['label' => __('label.label'), 'value' => $parameter->label])
                    @include('temps.tables.trHorizontal',['label' => __('label.typeParameter'), 'value' => EnumHelper::getLabel('TypesParameterEnum',$parameter->type_parameter)])
                    @include('temps.tables.trHorizontal',['label' => __('label.status'), 'value' => EnumHelper::getLabel('StatusEnum',$parameter->status)])
                </table>
            </div>
            <div class="col-12 col-md-6">
                <table class="table table-bordered">
                    @include('temps.tables.trHorizontal',['label' => __('label.groupParameter'), 'value' => $parameter->groupParameter->name ])
                    @include('temps.tables.trHorizontal',['label' => __('label.created_at'), 'value' => DateHelper::getString($parameter->created_at)])
                    @include('temps.tables.trHorizontal',['label' => __('label.updated_at'), 'value' => DateHelper::getString($parameter->updated_at)])
                </table>
            </div>
        </div>
    </div>
</div>
@if(Auth::user()->hasRole(trans('roles.parameterDelete')))
<div class="row">
    <div class="col-12 text-center">
        <hr/>
        <h3>@lang('message.confirmacaoDelete')</h3>
        {!! Form::open(['action' => array('ParameterController@deletePost',$parameter->parameter_id), 'method' => 'delete', 'class' => 'needs-validation', 'novalidate']) !!}
            {!! Form::hidden('parameter_id',$parameter->parameter_id) !!}
            {!! Form::submit(trans('button.delete'),  ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endif
@endsection