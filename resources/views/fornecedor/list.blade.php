@extends('temps.master')
@section('title', trans('fornecedor.title'))

@section('css-view')

@endsection

@section('js-view')
@endsection

@section('conteudo-view')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header border-bottom">
            <h2 class="pageheader-title  d-inline-block"><i class="fas fa-building"></i> @lang('fornecedor.title')</h2>
        </div>
    </div>
</div>

@include('temps.forms.message')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('fornecedor.subTitleListar')</h4>
                <a href="{{ action('FornecedorController@create') }}" class="btn btn-success btn-sm">@lang('botao.Incluir')</a>
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
                                                <a href="{{ action('FornecedorController@detalhe',$i->for_codigo) }}" class="btn btn-sm btn-outline-light">@lang('botao.Detalhes')</a>
                                                <a href="{{ action('FornecedorController@update',$i->for_codigo) }}" class="btn btn-sm btn-outline-light">@lang('botao.Editar')</a>
                                                <a href="{{ action('FornecedorController@delete',$i->for_codigo) }}" class="btn btn-sm btn-outline-light">
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



