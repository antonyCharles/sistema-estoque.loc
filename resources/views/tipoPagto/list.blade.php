@extends('temps.master')
@section('title', trans('tipoPagto.title'))
@section('title-icone', 'fas fa-clipboard-list')

@section('css-view')

@endsection

@section('js-view')
@endsection

@section('conteudo-view')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('tipoPagto.subTitleListar')</h4>
                @if(Auth::user()->hasRole(trans('roles.tipoPagtoCreate')))
                <a href="{{ action('TipoPagtoController@create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> @lang('botao.Incluir')
                </a>
                @endif
            </div>
            <div class="card-body">
                @if(isset($tipospagto) && count($tipospagto) > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('label.Descricao')</th>
                                    <th scope="col">@lang('label.Qtde')</th>
                                    <th scope="col">@lang('label.Ativo')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tipospagto as $i)
                                    <tr>
                                        <td>{{ $i->tpg_descricao }}</td>
                                        <td>{{ $i->tpg_qtde }}</td>
                                        <td>{{ ViewHelper::getEnumLabel($enumSimNao,$i->tpg_ativo) }}</td>
                                        <td class="text-right">
                                            <div class="btn-group ml-auto">
                                                @if(Auth::user()->hasRole(trans('roles.tipoPagtoUpdate')))
                                                <a href="{{ action('TipoPagtoController@update',$i->tpg_codigo) }}" class="btn btn-sm btn-outline-light">@lang('botao.Editar')</a>
                                                @endif
                                                @if(Auth::user()->hasRole(trans('roles.tipoPagtoDelete')))
                                                <a href="{{ action('TipoPagtoController@delete',$i->tpg_codigo) }}" class="btn btn-sm btn-outline-light">
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
                        @lang('msg.tabelaSemRegistros')
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection



