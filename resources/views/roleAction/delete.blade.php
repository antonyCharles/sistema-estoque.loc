@extends('temps.master')
@section('title', trans('titles.rolesActionsTitle'))
@section('title-icone', 'fas fa-cog')


@section('css-view')
@endsection
@section('js-view')
@endsection

@section('conteudo-view')
<div class="main-card mb-3 card">
    <div class="card-header d-flex justify-content-between bd-highlight">
        <h6 class="font-weight-bold">@lang('titles.delete')</h6>
        <div class="float-left">
            <a href="{{ URL::previous() }}" class="btn btn-outline-light btn-sm">
                <i class="fas fa-angle-left"></i> @lang('botao.Voltar')
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-6">
                <table class="table table-bordered">
                    @include('temps.tables.trHorizontal',['label' => __('label.name'), 'value' => $roleAction->name])
                    @include('temps.tables.trHorizontal',['label' => __('label.status'), 'value' => EnumHelper::getLabel('StatusEnum',$roleAction->status)])
                </table>
            </div>
            <div class="col-12 col-md-6">
                <table class="table table-bordered">
                    @include('temps.tables.trHorizontal',['label' => __('label.created_at'), 'value' => DateHelper::getString($roleAction->created_at)])
                    @include('temps.tables.trHorizontal',['label' => __('label.updated_at'), 'value' => DateHelper::getString($roleAction->updated_at)])
                </table>
            </div>
        </div>
    </div>
</div>

@if(Auth::user()->hasRole(trans('roles.roleActionDelete')))
<div class="row">
    <div class="col-12 text-center">
        <hr/>
        <h3>@lang('message.confirmacaoDelete')</h3>
        {!! Form::open(['action' => array('RoleActionController@deletePost',$roleAction->role_action_id), 'method' => 'delete', 'class' => 'needs-validation', 'novalidate']) !!}
            {!! Form::hidden('role_action_id',$roleAction->role_action_id) !!}
            {!! Form::submit(trans('button.delete'),  ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endif

@endsection