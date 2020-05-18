@extends('temps.master')
@section('title', trans('usuario.titleUsuario'))

@section('css-view')
@endsection
@section('js-view')
<script src="{{ asset('libs/js/pages/usuario-index.js') }}"></script>
@endsection

@section('conteudo-view')

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header border-bottom">
            <h2 class="pageheader-title  d-inline-block"><i class="fas fa-user"></i> @lang('usuario.titleUsuario')</h2>
            <div class="float-right">
            	<a href="{{ action('UsuarioController@Create') }}" class="btn btn-primary btn-sm" data-toggle="popover" data-placement="left" data-trigger="hover" data-content="@lang('usuario.msgNovoUsuario')">
                    <i class="fas fa-user"></i> @lang('botao.Incluir')
                </a>
            </div>
        </div>
    </div>
</div>

@include('temps.forms.message')

<div class="row">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">@lang('usuario.msgListaUsuario')</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">@lang('label.Id')</th>
                                <th scope="col">@lang('label.Nome')</th>
                                <th scope="col">@lang('label.Email')</th>
                                <th scope="col">@lang('label.Perfil')</th>
                                <th scope="col">@lang('label.Status')</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Usuarios as $u)
                            <tr>
                                <th scope="row">{{ $u->id }}</th>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->perfil->nome }}</td>
                                <td>{{ $u->status == 'A' ? trans('label.Ativo') : trans('label.Inativo') }}</td>
                                <td class="text-right">
                                    <div class="btn-group ml-auto">
                                        <a href="{{ action('UsuarioController@Detalhe',$u->id) }}" class="btn btn-sm btn-outline-light">@lang('botao.Detalhes')</a>
                                        
                                        <a href="{{ action('UsuarioController@Edit',$u->id) }}" class="btn btn-sm btn-outline-light">@lang('botao.Editar')</a>
                                        
                                        <a 
                                            href="javascript:void(0)" 
                                            class="btn btn-sm btn-outline-light"  
                                            data-toggle="modal" 
                                            data-target="#deleteModal" 
                                            data-id="{{ $u->id }}"
                                            data-nome="{{ $u->name }}">
                                                <i class="far fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        {!! Form::open(['action' => array('UsuarioController@Delete'), 'method' => 'post']) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('perfil.msgDelGrFunc')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tbody>
                            {!! Form::hidden('id',null,['required']) !!} 
                            @include('temps.tables.trHorizontal',['label' => trans('label.Nome'), 'class' => 'nomeUsuario'])
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('botao.Sair')</button>
                    <button type="submit" class="btn btn-primary">@lang('botao.Deletar')</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection
