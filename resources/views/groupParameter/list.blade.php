@extends('temps.master')
@section('title', trans('titles.groupsParametersTitle'))
@section('title-icone', 'fas fa-cog')


@section('css-view')
@endsection
@section('js-view')
@endsection

@section('conteudo-view')
<div class="main-card mb-3 card">
    <div class="card-header">
        <h4 class="card-title">@lang('titles.list')</h4>
        @if(Auth::user()->hasRole(trans('roles.groupParameterCreate')))
        <a href="{{ action('GroupParameterController@create') }}" class="btn btn-success btn-sm">
            <i class="fas fa-plus"></i> @lang('button.create')
        </a>
        @endif
    </div>
    <div class="card-body">
        @if(isset($groupsParameters) && count($groupsParameters) > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>@lang('label.id')</th>
                        <th>@lang('label.name')</th>
                        <th>@lang('label.created_at')</th>
                        <th>@lang('label.updated_at')</th>
                        <th>@lang('label.status')</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($groupsParameters as $i)
                        <tr>
                            <th>{{ $i->group_parameter_id }}</th>
                            <td>{{ $i->name }}</td>
                            <td>{{ DateHelper::getString($i->created_at) }}</td>
                            <td>{{ DateHelper::getString($i->updated_at) }}</td>
                            <td>{{ EnumHelper::getLabel('StatusEnum',$i->status) }}</td>
                            <td class="text-right">
                                <div class="btn-group ml-auto">
                                    @if(Auth::user()->hasRole(trans('roles.groupParameterUpdate')))
                                    <a href="{{ action('GroupParameterController@update',$i->group_parameter_id) }}" class="btn btn-sm btn-outline-light">@lang('button.update')</a>
                                    @endif
                                    @if(Auth::user()->hasRole(trans('roles.groupParameterDelete')))
                                    <a href="{{ action('GroupParameterController@delete',$i->group_parameter_id) }}" class="btn btn-sm btn-outline-light">
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