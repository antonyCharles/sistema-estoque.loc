@extends('temps.master')
@section('title', trans('titles.rolesProfileTitle'))
@section('title-icone', 'fas fa-cog')

@section('css-view')
<link href="{{ asset('css/plugins/treeview.css') }}" rel="stylesheet" />
<style>
.custom-control-label{
    cursor:pointer;
}
.custom-control-label::before {
    height: 26px;
    width: 26px;
}
.custom-control-label::after {
    background-size: 60% 60%;
    height: 26px;
    width: 26px;
}
table .custom-checkbox, table .custom-radio{
    margin:0px;
}
</style>
@endsection
@section('js-view')
<script src="{{ asset('js/plugins/treeview.js') }}"></script>
<script src="{{ asset('js/update-role-profile.js') }}"></script>
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
            <div class="col-12 col-md-12">
                <table class="table table-bordered">
                    @include('temps.tables.trHorizontal',['label' => __('label.name'), 'value' => $profile->name])
                    @include('temps.tables.trHorizontal',['label' => __('label.description'), 'value' => $profile->description])
                </table>
            </div>
        </div>
    </div>
</div>


<div class="main-card mb-3 card">
    <div class="card-header">
        <h4>@lang('titles.addRolesToProfile')</h4>
    </div>
    <div class="card-body">
        @if(Auth::user()->hasRole(trans('roles.roleProfileUpdate')))
        {!! Form::open(['action' => array('RoleProfileController@updatePost',$profile->profile_id ), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
        {!! Form::hidden('profile_id',$profile->profile_id) !!}
        @endif
        <table class="tree table">
            <thead>
                <tr>
                    <th>@lang('label.name')</th>
                    <th>@lang('label.status')</th>
                    <th class="text-center">@lang('label.total')</th>
                    <th class="text-center">@lang('label.roleAction')</th>
                    <th class="text-center">@lang('label.none')</th>
                </tr>
            </thead>
            <tbody>
                <?php $GLOBALS['roleCount'] = 0; ?>
                @foreach($roles as $role)
                    @include('roleProfile.trs.trHtml',['r' => $role])
                    
                    @foreach($role->allChildrenRoles as $childRole)
                        @include('roleProfile.trs.childRole',['child_role' => $childRole])
                    @endforeach
                @endforeach
                <?php unset($GLOBALS['roleCount']); ?>
            </tbody>
        </table>
        <br/>
        @if(Auth::user()->hasRole(trans('roles.roleProfileUpdate')))
        <div class="row t-2">
            <div class="col-12 text-right">
                {!! Form::submit(trans('button.update'),  ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
        {!! Form::close() !!}
        @endif
    </div>
</div>


@endsection