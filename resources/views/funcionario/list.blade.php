@extends('temps.master')
@section('title', trans('funcionario.title'))
@section('title-icone', 'fas fa-users')

@section('css-view')

@endsection

@section('js-view')
@endsection

@section('conteudo-view')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">@lang('funcionario.subTitleListar')</h4>
                @if(Auth::user()->hasRole(trans('roles.userCreate')))
                <a href="{{ action('FuncionarioController@create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> @lang('botao.Incluir')
                </a>
                @endif
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
                                        <td>{{ $i->name }}</td>
                                        <td>{!! ViewHelper::getEnumLabel($enumSexo,$i->fun_sexo) !!}</td>
                                        <td>{{ ViewHelper::getDateFormat($i->fun_nascimento) }}</td>
                                        <td>{{ $i->email }}</td>
                                        <td>{{ $i->fun_cnpjcpf }}</td>
                                        <td class="text-right">
                                            <div class="btn-group ml-auto">
                                                @if(Auth::user()->hasRole(trans('roles.userRead')))
                                                <a href="{{ action('FuncionarioController@detalhe',$i->fun_codigo) }}" class="btn btn-sm btn-outline-light">@lang('botao.Detalhes')</a>
                                                @endif
                                                @if(Auth::user()->hasRole(trans('roles.userUpdate')))
                                                <a href="{{ action('FuncionarioController@update',$i->fun_codigo) }}" class="btn btn-sm btn-outline-light">@lang('botao.Editar')</a>
                                                @endif
                                                @if(Auth::user()->hasRole(trans('roles.userDelete')))
                                                <a href="{{ action('FuncionarioController@delete',$i->fun_codigo) }}" class="btn btn-sm btn-outline-light">
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



