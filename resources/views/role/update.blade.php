@extends('temps.master')
@section('title', trans('titles.rolesSystemTitle'))
@section('title-icone', 'fas fa-cog')


@section('css-view')
<link href="{{ asset('css/plugins/treeview.css') }}" rel="stylesheet" />
<style>
    table{
        min-width:900px;
    }
    tr .item{
        margin-bottom:0px;
    }
</style>
@endsection
@section('js-view')
<script src="{{ asset('js/plugins/parsley.js') }}"></script>
<script src="{{ asset('js/validation-form.js') }}"></script>
<script src="{{ asset('js/plugins/treeview.js') }}"></script>
<script src="{{ asset('js/form-treeview-role.js') }}"></script>
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
        @if(Auth::user()->hasRole(trans('roles.roleUpdate')))
        {!! Form::open(['action' => array('RoleController@updatePost'), 'method' => 'post', 'id' => 'form-roles', 'class' => 'needs-validation', 'novalidate']) !!}
        @endif
        <div class="table-responsive">
            <table class="tree table">
                <thead>
                    <tr>
                        <th></th>
                        <th>@lang('label.name')</th>
                        <th style="width:10%">@lang('label.role')</th>
                        <th style="width:15%">@lang('label.roleFather')</th>
                        <th style="width:15%">@lang('label.roleAction')</th>
                        <th style="width:10%">@lang('label.status')</th>
                        <th class="text-right"  style="width:10%">
                            <button type="button" id="add-item-list-roles" class="btn-transition btn btn-success">
                                <i class="fa fa-fw" aria-hidden="true" title="Copy to use plus"></i>
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody id="list-roles">
                    @foreach($roles as $role)
                        @include('role.trs.trHtmlForm',['r' => $role])

                        @foreach($role->allChildrenRoles as $childRole)
                            @include('role.trs.childRole',['child_role' => $childRole])
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
        <br/>
        @if(Auth::user()->hasRole(trans('roles.roleUpdate')))
        <div class="row t-2">
            <div class="col-12 text-right">
                {!! Form::submit(trans('button.update'),  ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
        {!! Form::close() !!}
        @endif
    </div>
</div>

<script id="temp-item-role-list" type="text/template">
        <td>
            <span class="text-success text-name">Novo Item</span>
            {!! Form::hidden('role_id[]',null,['class' => 'input-role_id']) !!}
            {!! Form::hidden('item_status[]','insert',['class' => 'item_status']) !!}
        </td>
        <td>
            @include('temps.forms.inputNotLabel',[
                'input' => 'name[]', 
                'label' => trans('label.name'), 
                'value' => null , 
                'attr' => ['class' => 'input-name form-control','required']])
        </td>
        <td>
            @include('temps.forms.inputNumberNotLabel',[
                'input' => 'role[]', 
                'label' => trans('label.role'), 
                'value' => null, 
                'attr' => ['class' => 'role_number form-control','required']])
        </td>
        <td>
            @include('temps.forms.selectNotLabel',[
                'input' => 'role_father_id[]',
                'label' => trans('label.roleFather'), 
                'value' => null, 
                'list' => $rolesSelect->pluck('name','role_id'), 
                'attr' => ['placeholder' => trans('label.select'),'class' => 'role_father_id form-control','disabled']])
        </td>
        <td>
            @include('temps.forms.selectNotLabel',[
                'input' => 'role_action_id[]',
                'label' => trans('label.roleAction'), 
                'value' => null, 
                'list' => $rolesActions, 
                'attr' => ['placeholder' => trans('label.select'),'class' => 'role_action_id form-control']])
        </td>
        <td>
            @include('temps.forms.selectNotLabel',[
                'input' => 'status[]',
                'label' => trans('label.status'), 
                'value' => 'A', 
                'list' => EnumHelper::getEnum('StatusEnum'), 
                'attr' => ['placeholder' => trans('label.select'),'class' => 'input-status form-control','required']])
        </td>
        <td class="text-right">
            <div class="btn-group ml-auto">
                <button type="button" class="button-remove btn-transition btn-sm btn btn-danger">
                    <i class="fa fa-fw" aria-hidden="true" title="Copy to use trash"></i>
                </button>
            </div>
        </td>
</script>

@endsection