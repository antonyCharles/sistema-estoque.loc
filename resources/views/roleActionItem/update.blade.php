@extends('temps.master')
@section('title', trans('titles.rolesActionsTitle'))
@section('title-icone', 'fas fa-cog')


@section('css-view')
<style>
    .table-action-item{
        min-width:900px;
    }
    .table-action-item tr .item{
        margin-bottom:0px;
    }
</style>
@endsection
@section('js-view')
<script src="{{ asset('js/plugins/parsley.js') }}"></script>
<script src="{{ asset('js/validation-form.js') }}"></script>
<script src="{{ asset('js/update-role-action-item.js') }}"></script>
@endsection

@section('conteudo-view')
<div class="main-card mb-3 card">
    <div class="card-header">
        <h4 class="card-title">@lang('titles.detail')</h4>
        <a href="{{ URL::previous() }}" class="btn btn-outline-light btn-sm">
            <i class="fas fa-angle-left"></i> @lang('botao.Voltar')
        </a>
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

<div class="main-card mb-3 card">
    <div class="card-header">
        <h4>@lang('titles.updateRoleActionsItens')</h4>
    </div>
    <div class="card-body">
        @if(Auth::user()->hasRole(trans('roles.roleActionItemUpdate')))
        {!! Form::open(['action' => array('RoleActionItemController@updatePost',$roleAction->role_action_id), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
        {!! Form::hidden('role_action_id',$roleAction->role_action_id) !!}
        @endif
        <div class="table-responsive">
            <table class="table table-action-item">
                <thead>
                    <tr>
                        <th>@lang('label.name')</th>
                        <th>@lang('label.slug')</th>
                        <th>@lang('label.status')</th>
                        <th class="text-right"  style="width:10%">
                            <button type="button" id="add-role-action-item" class="btn-transition btn btn-success">
                                <i class="fa fa-fw" aria-hidden="true" title="Copy to use plus"></i>
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roleAction->roleActionItens as $rai)
                        <tr>
                        @include('roleActionItem.trs.trHtml',['rai' => $rai])
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br/>
        @if(Auth::user()->hasRole(trans('roles.roleActionItemUpdate')))
        <div class="row t-2">
            <div class="col-12 text-right">
                {!! Form::submit(trans('button.update'),  ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
        {!! Form::close() !!}
        @endif
    </div>
</div>

<script id="temp-action-item" type="text/template">
    @include('roleActionItem.trs.trHtml',['rai' => ''])
</script>


@endsection