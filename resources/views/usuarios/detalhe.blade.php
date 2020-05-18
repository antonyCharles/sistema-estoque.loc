@extends('temps.master')
@section('title', trans('usuario.titleUsuario'))

@section('css-view')

@endsection

@section('js-view')

@endsection

@section('conteudo-view')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header border-bottom">
            <h2 class="pageheader-title  d-inline-block"><i class="fas fa-user"></i> @lang('usuario.titleUsuario')</h2>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
                <h3 class="d-inline-block m-0 p-1">@lang('usuario.titleInfoUsuario')</h3>
                <div class="float-right">
                    <a href="{{ action('UsuarioController@Edit',$Usuario->id) }}" class="btn btn-primary btn-sm" data-toggle="popover" data-placement="left" data-trigger="hover" data-content="@lang('usuario.msgAlterar')">
                        <i class="fas fa-address-book"></i> @lang('botao.Alterar')
                    </a>
                </div>
            </div>
			<div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            @include('temps.tables.trHorizontal',['label' => __('label.Id'), 'value' => $Usuario->id])
                            @include('temps.tables.trHorizontal',['label' => __('label.Nome'), 'value' => $Usuario->name])
                            @include('temps.tables.trHorizontal',['label' => __('label.Email'), 'value' => $Usuario->email])
                            @include('temps.tables.trHorizontal',['label' => __('label.Perfil'), 'value' => $Usuario->perfil->nome])
                            @include('temps.tables.trHorizontal',['label' => __('label.Status'), 'value' => ($Usuario->status == 'A' ? trans('label.Ativo') : trans('label.Inativo'))])
                        </tbody>
                    </table>
                </div>
			</div>
		</div>
	</div>
</div>
@endsection
