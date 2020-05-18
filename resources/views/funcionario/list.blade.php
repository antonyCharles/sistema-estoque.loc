@extends('temps.master')
@section('title', trans('funcionario.title'))

@section('css-view')

@endsection

@section('js-view')
@endsection

@section('conteudo-view')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header border-bottom">
            <h2 class="pageheader-title  d-inline-block"><i class="fas fa-users"></i> @lang('funcionario.title')</h2>
        </div>
    </div>
</div>

@include('temps.forms.message')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('funcionario.subTitleListar')</h4>
                <a href="{{ action('FuncionarioController@create') }}" class="btn btn-success btn-sm">@lang('botao.Incluir')</a>
            </div>
            <div class="card-body">
                @if(isset($funcionarios) && count($funcionarios) > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('label.Nome')</th>
                                    <th scope="col">@lang('label.Sexo')</th>
                                    <th scope="col">@lang('label.DtNascimento')</th>
                                    <th scope="col">@lang('label.Email')</th>
                                    <th scope="col">@lang('label.CnpjCpf')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($funcionarios as $i)
                                    <tr>
                                        <td>{{ $i->fun_nome }}</td>
                                        <td>{!! ViewHelper::getEnumLabel($enumSexo,$i->fun_sexo) !!}</td>
                                        <td>{{ ViewHelper::getDateFormat($i->fun_nascimento) }}</td>
                                        <td>{{ $i->fun_email }}</td>
                                        <td>{{ $i->fun_cnpjcpf }}</td>
                                        <td class="text-right">
                                            <div class="btn-group ml-auto">
                                                <a href="{{ action('FuncionarioController@detalhe',$i->fun_codigo) }}" class="btn btn-sm btn-outline-light">@lang('botao.Detalhes')</a>
                                                <a href="{{ action('FuncionarioController@update',$i->fun_codigo) }}" class="btn btn-sm btn-outline-light">@lang('botao.Editar')</a>
                                                <a href="{{ action('FuncionarioController@delete',$i->fun_codigo) }}" class="btn btn-sm btn-outline-light">
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



