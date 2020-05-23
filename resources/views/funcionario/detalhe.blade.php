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
                <h4 class="card-title">@lang('funcionario.subTitleDetalhe')</h4>
                <a href="{{ URL::previous() }}" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-angle-left"></i> @lang('botao.Voltar')
                </a>
                @if(Auth::user()->hasRole(trans('roles.userUpdate')))
                <a href="{{ action('FuncionarioController@update',$funcionario->fun_codigo) }}" class="btn btn-info btn-sm">@lang('botao.Alterar')</a>
                @endif
            </div>
			<div class="card-body">
                <div class="row">
                    <div class="col1-12 col-md-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @include('temps.tables.trHorizontal',['label' => __('label.Nome'), 'value' => $funcionario->name])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Sexo'), 'value' => ViewHelper::getEnumLabel($enumSexo,$funcionario->fun_sexo)])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Salario'), 'value' => 'R$ ' . ViewHelper::getValorMonetarioFormat($funcionario->fun_salario)])
                                    @include('temps.tables.trHorizontal',['label' => __('label.CnpjCpf'), 'value' => $funcionario->fun_cnpjcpf])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Rgie'), 'value' => $funcionario->fun_rgie])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Telefone'), 'value' => $funcionario->fun_telefone])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Celular'), 'value' => $funcionario->fun_celular])
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col1-12 col-md-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @include('temps.tables.trHorizontal',['label' => __('label.Email'), 'value' => $funcionario->email])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Endereco'), 'value' => $funcionario->fun_endereco])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Numero'), 'value' => $funcionario->fun_numero])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Complemento'), 'value' => $funcionario->fun_complemento])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Bairro'), 'value' => $funcionario->fun_bairro])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Cidade'), 'value' => $funcionario->fun_cidade])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Uf'), 'value' => $funcionario->fun_uf])
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>

@endsection
