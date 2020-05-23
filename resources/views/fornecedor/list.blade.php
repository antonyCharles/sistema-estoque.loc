@extends('temps.master')
@section('title', trans('fornecedor.title'))
@section('title-icone', 'fas fa-building')

@section('css-view')

@endsection

@section('js-view')
@endsection

@section('conteudo-view')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('fornecedor.subTitleListar')</h4>
                @if(Auth::user()->hasRole(trans('roles.fornecedorCreate')))
                <a href="{{ action('FornecedorController@create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> @lang('botao.Incluir')
                </a>
                @endif
            </div>
            <div class="card-body">
                @if(isset($fornecedores) && count($fornecedores) > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('label.Nome')</th>
                                    <th scope="col">@lang('label.CnpjCpf')</th>
                                    <th scope="col">@lang('label.Email')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fornecedores as $i)
                                    <tr>
                                        <td>{{ $i->for_nome }}</td>
                                        <td>{{ $i->for_cnpjcpf }}</td>
                                        <td>{{ $i->for_email }}</td>
                                        <td class="text-right">
                                            <div class="btn-group ml-auto">
                                                @if(Auth::user()->hasRole(trans('roles.fornecedorRead')))
                                                <a href="{{ action('FornecedorController@detalhe',$i->for_codigo) }}" class="btn btn-sm btn-outline-light">@lang('botao.Detalhes')</a>
                                                @endif
                                                @if(Auth::user()->hasRole(trans('roles.fornecedorUpdate')))
                                                <a href="{{ action('FornecedorController@update',$i->for_codigo) }}" class="btn btn-sm btn-outline-light">@lang('botao.Editar')</a>
                                                @endif
                                                @if(Auth::user()->hasRole(trans('roles.fornecedorDelete')))
                                                <a href="{{ action('FornecedorController@delete',$i->for_codigo) }}" class="btn btn-sm btn-outline-light">
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



