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
        <h4 class="card-title">@lang('titles.delete')</h4>
        <a href="{{ URL::previous() }}" class="btn btn-outline-light btn-sm">
            <i class="fas fa-angle-left"></i> @lang('botao.Voltar')
        </a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-6">
                <table class="table table-bordered">
                    @include('temps.tables.trHorizontal',['label' => __('label.name'), 'value' => $profile->name])
                    @include('temps.tables.trHorizontal',['label' => __('label.status'), 'value' => EnumHelper::getLabel('StatusEnum',$profile->status)])
                    @include('temps.tables.trHorizontal',['label' => __('label.description'), 'value' => $profile->description])
                </table>
            </div>
            <div class="col-12 col-md-6">
                <table class="table table-bordered">
                    @include('temps.tables.trHorizontal',['label' => __('label.created_at'), 'value' => DateHelper::getString($profile->created_at)])
                    @include('temps.tables.trHorizontal',['label' => __('label.updated_at'), 'value' => DateHelper::getString($profile->updated_at)])
                </table>
            </div>
        </div>
    </div>
</div>
@if(Auth::user()->hasRole(trans('roles.profileDelete')))
<div class="row">
    <div class="col-12 text-center">
        <hr/>
        <h3>@lang('message.confirmacaoDelete')</h3>
        {!! Form::open(['action' => array('ProfileController@deletePost',$profile->profile_id), 'method' => 'delete', 'class' => 'needs-validation', 'novalidate']) !!}
            {!! Form::hidden('profile_id',$profile->profile_id) !!}
            {!! Form::submit(trans('button.delete'),  ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endif
@endsection