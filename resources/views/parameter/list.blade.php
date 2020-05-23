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
        <h4 class="card-title">@lang('titles.list')</h4>
        @if(Auth::user()->hasRole(trans('roles.parameterCreate')))
        <a href="{{ action('ParameterController@create') }}" class="btn btn-sm btn-success">
            <i class="fas fa-plus"></i> @lang('button.create')
        </a>
        @endif
    </div>
    <div class="card-body">
        @if(isset($parameters) && count($parameters) > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>@lang('label.id')</th>
                        <th>@lang('label.label')</th>
                        <th>@lang('label.groupParameter')</th>
                        <th>@lang('label.typeParameter')</th>
                        <th>@lang('label.status')</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($parameters as $i)
                        <tr>
                            <th>{{ $i->parameter_id }}</th>
                            <td>{{ $i->label }}</td>
                            <td>{{ $i->groupParameter->name }}</td>
                            <td>{{ EnumHelper::getLabel('TypesParameterEnum',$i->type_parameter) }}</td>
                            <td>{{ EnumHelper::getLabel('StatusEnum',$i->status) }}</td>
                            <td class="text-right">
                                <div class="btn-group ml-auto">
                                    @if(Auth::user()->hasRole(trans('roles.parameterUpdate')))
                                    <a href="{{ action('ParameterController@update',$i->parameter_id) }}" class="btn btn-sm btn-outline-light">@lang('button.update')</a>
                                    @endif
                                    @if(Auth::user()->hasRole(trans('roles.parameterDelete')))
                                    <a href="{{ action('ParameterController@delete',$i->parameter_id) }}" class="btn btn-sm btn-outline-light">
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