@extends('temps.master')
@section('title', trans('titles.parametersProfileTitle'))
@section('title-icone', 'fas fa-cog')

@section('css-view')
<link href="{{ asset('css/plugins/multiselect.min.css') }}" rel="stylesheet" />
@endsection
@section('js-view')
<script src="{{ asset('js/plugins/multiselect.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
@endsection

@section('conteudo-view')
<div class="main-card mb-3 card">
    <div class="card-header">
        <h4 class="card-title">@lang('titles.profileTitle')</h4>
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
        <h4>@lang('titles.addParameterProfile')</h4>
    </div>
    <div class="card-body">
        {!! Form::open(['action' => array('ParameterProfileController@updatePost',$profile->profile_id), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
            {!! Form::hidden('profile_id',$profile->profile_id) !!}

            @if(isset($groupsParameters) && count($groupsParameters) > 0)
                
                <?php $count = 0; ?>
                @foreach($groupsParameters as $gp)
                    @if(count($gp->parameters) > 0)
                    <a href="javascript:void(0)" class="p-3 bg-dark text-white btn-block" 
                        data-toggle="collapse" data-target="#group-{{ $gp->group_parameter_id }}">
                            <h5 class="m-0 text-white">{{ $gp->name }}</h5>
                    </a>
                    <div id="group-{{ $gp->group_parameter_id }}" class="collapse show">
                        <div class="border p-2">
                            <div class="row">
                                @if(isset($gp->parameters))
                                    @foreach($gp->parameters as $i)
                                    <div class="col-12 col-md-3">
                                        <?php
                                            $parameterProfile = $profile->parametersProfile->where('parameter_id', $i->parameter_id)->first();
                                        ?>
                                        {!! Form::hidden('parameter_id[' . $count . ']',$i->parameter_id) !!}
                                        {!! Form::hidden('parameter_profile_id[' . $count . ']',$parameterProfile->parameter_profile_id ?? null) !!}

                                        @if($i->type_parameter == 'I')
                                            <div class="form-group">
                                                {!! Form::label( 'value[' . $count  . ']' , $i->label , ['class' => 'control-label']) !!}:
                                                {!! Form::text('value[' . $count  . ']', $parameterProfile->value ?? null, ['class' => 'form-control']) !!}
                                            </div>
                                        @endif

                                        @if($i->type_parameter == 'N')
                                            <div class="form-group">
                                                {!! Form::label( 'value[' . $count  . ']' , $i->label , ['class' => 'control-label']) !!}:
                                                {!! Form::number('value[' . $count  . ']', $parameterProfile->value ?? null, ['class' => 'form-control']) !!}
                                            </div>
                                        @endif

                                        @if($i->type_parameter == 'S')
                                            <div class="form-group">
                                                {!! Form::label( 'value[' . $count  . ']' , $i->label , ['class' => 'control-label']) !!}:
                                                {!! Form::select(
                                                        'value[' . $count  . ']',
                                                        json_decode($i->values_select) ?? [], 
                                                        $parameterProfile->value ?? null, 
                                                        [
                                                            'class' => 'form-control',
                                                            'placeholder' => trans('label.select')
                                                        ]); 
                                                !!}
                                            </div>
                                        @endif

                                        @if($i->type_parameter == 'M')
                                            <div class="form-group">
                                                {!! Form::label( 'value[' . $count  . ']' , $i->label , ['class' => 'control-label']) !!}:
                                                {!! Form::select(
                                                        'value[' . $count  . '][]',
                                                        json_decode($i->values_select) ?? [], 
                                                        isset($parameterProfile->value) ? json_decode($parameterProfile->value) : null, 
                                                        [
                                                            'class' => 'form-control js-example-basic-multiple',
                                                            'multiple'=>'multiple'
                                                        ]); 
                                                !!}
                                            </div>
                                        @endif

                                    </div>
                                    <?php $count++; ?>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <br/>
                    @endif
                @endforeach
                
            @else
                <div class="alert alert-secondary" role="alert">
                    @lang('message.tabelaSemRegistros')
                </div>
            @endif
            <br/>
            <div class="row t-2">
                <div class="col-12 text-right">
                    {!! Form::submit(trans('button.update'),  ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection