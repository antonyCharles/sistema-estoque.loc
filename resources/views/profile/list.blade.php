@extends('temps.master')
@section('title', trans('titles.profilesTitle'))
@section('title-icone', 'fas fa-cog')

@section('css-view')
@endsection
@section('js-view')
@endsection

@section('conteudo-view')
<div class="main-card mb-3 card">
    <div class="card-header">
        <h4 class="card-title">@lang('titles.list')</h4>
        @if(Auth::user()->hasRole(trans('roles.profileCreate')))
        <a href="{{ action('ProfileController@create') }}" class="btn btn-success btn-sm">
            <i class="fas fa-plus"></i> @lang('botao.Incluir')
        </a>
        @endif
    </div>
    <div class="card-body">
        @if(isset($profiles) && count($profiles) > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>@lang('label.id')</th>
                        <th>@lang('label.name')</th>
                        <th>@lang('label.description')</th>
                        <th>@lang('label.status')</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($profiles as $i)
                        <tr>
                            <th>{{ $i->profile_id }}</th>
                            <td>{{ $i->name }}</td>
                            <td>{{ $i->description }}</td>
                            <td>{{ EnumHelper::getLabel('StatusEnum',$i->status) }}</td>
                            <td class="text-right">
                                <div class="btn-group ml-auto">
                                    @if(Auth::user()->hasRole(trans('roles.profileUpdate')))
                                    <a href="{{ action('ProfileController@update',$i->profile_id) }}" class="btn btn-sm btn-outline-light">@lang('button.update')</a>
                                    @endif
                                    @if(Auth::user()->hasRole(trans('roles.parameterProfileRead')))
                                    <a href="{{ action('ParameterProfileController@update',$i->profile_id) }}" class="btn btn-sm btn-outline-light">@lang('button.parameterProfile')</a>
                                    @endif
                                    @if(Auth::user()->hasRole(trans('roles.roleProfileRead')))
                                    <a href="{{ action('RoleProfileController@update',$i->profile_id) }}" class="btn btn-sm btn-outline-light">@lang('button.role')</a>
                                    @endif
                                    @if(Auth::user()->hasRole(trans('roles.profileDelete')))
                                    <a href="{{ action('ProfileController@delete',$i->profile_id) }}" class="btn btn-sm btn-outline-light">
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
        @else
            <div class="alert alert-secondary" role="alert">
                @lang('message.tabelaSemRegistros')
            </div>
        @endif
    </div>
</div>

@endsection