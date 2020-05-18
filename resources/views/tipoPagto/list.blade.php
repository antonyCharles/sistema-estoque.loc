@extends('temps.master')
@section('title', trans('tipoPagto.title'))

@section('css-view')

@endsection

@section('js-view')
@endsection

@section('conteudo-view')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header border-bottom">
            <h2 class="pageheader-title  d-inline-block"><i class="fas fa-clipboard-list"></i> @lang('tipoPagto.title')</h2>
        </div>
    </div>
</div>

@include('temps.forms.message')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('tipoPagto.subTitleListar')</h4>
                <a href="{{ action('TipoPagtoController@create') }}" class="btn btn-success btn-sm">@lang('botao.Incluir')</a>
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
                                                <a href="{{ action('TipoPagtoController@update',$i->tpg_codigo) }}" class="btn btn-sm btn-outline-light">@lang('botao.Editar')</a>
                                                <a href="{{ action('TipoPagtoController@delete',$i->tpg_codigo) }}" class="btn btn-sm btn-outline-light">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
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



