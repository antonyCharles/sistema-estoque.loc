@extends('temps.master')
@section('title', trans('titles.systemTitle'))
@section('title-icone', 'fas fa-cog')


@section('css-view')
<link href="{{ asset('css/plugins/treeview.css') }}" rel="stylesheet" />
@endsection
@section('js-view')
<script src="{{ asset('js/plugins/treeview.js') }}"></script>
<script type="text/javascript">
$('.tree').treegrid();
</script>
@endsection

@section('conteudo-view')
<div class="main-card mb-3 card">
    <div class="card-header">
        <h4 class="card-title">@lang('titles.detail')</h4>
        @if(Auth::user()->hasRole(trans('roles.systemUpdate')))
        <a href="{{ action('SystemController@update') }}" class="btn btn-sm btn-success">
            <i class="far fa-edit"></i> @lang('button.update')
        </a>
        @endif
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-6">
                <table class="table table-bordered">
                    @include('temps.tables.trHorizontal',['label' => __('label.name'), 'value' => $system->name])
                    @include('temps.tables.trHorizontal',['label' => __('label.abrrev'), 'value' => $system->abrrev])
                    @include('temps.tables.trHorizontal',['label' => __('label.description'), 'value' => $system->description])
                </table>
            </div>
            <div class="col-12 col-md-6">
                <table class="table table-bordered">
                    @include('temps.tables.trHorizontal',['label' => __('label.status'), 'value' => EnumHelper::getLabel('StatusEnum',$system->status)])
                    @include('temps.tables.trHorizontal',['label' => __('label.created_at'), 'value' => DateHelper::getString($system->created_at)])
                    @include('temps.tables.trHorizontal',['label' => __('label.updated_at'), 'value' => DateHelper::getString($system->updated_at)])
                </table>
            </div>
        </div>
    </div>
</div>

@if(Auth::user()->hasRole(trans('roles.role')))
<div class="main-card mb-3 card">
    <div class="card-header">
        <h4 class="card-title">@lang('titles.roles')</h4>
        @if(Auth::user()->hasRole(trans('roles.roleRead')))
        <a href="{{ action('RoleController@update') }}" class="btn btn-sm btn-primary">
            <i class="far fa-edit"></i> @lang('button.updateRoles')
        </a>
        @endif
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="tree table">
                <thead>
                    <tr>
                        <th>@lang('label.name')</th>
                        <th>@lang('label.role')</th>
                        <th>@lang('label.roleAction')</th>
                        <th>@lang('label.status')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        @include('system.trs.trHtml',['r' => $role])
                        
                        @foreach($role->allChildrenRoles as $childRole)
                            @include('system.trs.childRole',['child_role' => $childRole])
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

@if(Auth::user()->hasRole(trans('roles.roleAction')))
<div class="main-card mb-3 card">
    <div class="card-header">
        <h4 class="card-title">@lang('titles.rolesActionsTitle')</h4>
        @if(Auth::user()->hasRole(trans('roles.roleActionCreate')))
        <a href="{{ action('RoleActionController@create') }}" class="btn btn-sm btn-primary">
            <i class="far fa-edit"></i> @lang('button.create')
        </a>
        @endif
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="tree table">
                <thead>
                    <tr>
                        <th>@lang('label.name')</th>
                        <th>@lang('label.status')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rolesActions as $i)
                        <tr>
                            <td>{{ $i->name }}</td>
                            <td>{{ EnumHelper::getLabel('StatusEnum',$i->status) }}</td>
                            <td class="text-right">
                                <div class="btn-group ml-auto">
                                    @if(Auth::user()->hasRole(trans('roles.roleActionUpdate')))
                                    <a href="{{ action('RoleActionController@update',$i->role_action_id) }}" class="btn btn-sm btn-outline-light">@lang('button.update')</a>
                                    @endif
                                    @if(Auth::user()->hasRole(trans('roles.roleActionItemRead')))
                                    <a href="{{ action('RoleActionItemController@update',$i->role_action_id) }}" class="btn btn-sm btn-outline-light">@lang('button.roleActionItens')</a>
                                    @endif
                                    @if(Auth::user()->hasRole(trans('roles.roleActionDeleter')))
                                    <a href="{{ action('RoleActionController@delete',$i->role_action_id) }}" class="btn btn-sm btn-outline-light">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

@endsection