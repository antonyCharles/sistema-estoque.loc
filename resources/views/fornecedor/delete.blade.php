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
                <h4 class="card-title">@lang('fornecedor.subTitleDeletar')</h4>
                <a href="{{ URL::previous() }}" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-angle-left"></i> @lang('botao.Voltar')
                </a>
            </div>
			<div class="card-body">
                <div class="row">
                    <div class="col1-12 col-md-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @include('temps.tables.trHorizontal',['label' => __('label.Nome'), 'value' => $fornecedor->for_nome])
                                    @include('temps.tables.trHorizontal',['label' => __('label.CnpjCpf'), 'value' => $fornecedor->for_cnpjcpf])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Rgie'), 'value' => $fornecedor->for_rgie])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Telefone'), 'value' => $fornecedor->for_telefone])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Celular'), 'value' => $fornecedor->for_celular])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Fax'), 'value' => $fornecedor->for_fax])
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col1-12 col-md-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @include('temps.tables.trHorizontal',['label' => __('label.Email'), 'value' => $fornecedor->for_email])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Endereco'), 'value' => $fornecedor->for_endereco])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Numero'), 'value' => $fornecedor->for_numero])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Bairro'), 'value' => $fornecedor->for_bairro])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Cidade'), 'value' => $fornecedor->for_cidade])
                                    @include('temps.tables.trHorizontal',['label' => __('label.Uf'), 'value' => $fornecedor->for_uf])
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->hasRole(trans('roles.fornecedorDelete')))
                <div class="row">
                    <div class="col-12 text-center">
                        <hr/>
                        <h3>@lang('msg.ConfirmacaoDelete')</h3>
                        {!! Form::open(['action' => array('FornecedorController@deletePost',$fornecedor->for_codigo ?? null), 'method' => 'post', 'class' => 'needs-validation', 'novalidate']) !!}
                            {!! Form::hidden('for_codigo',$fornecedor->for_codigo) !!}
                            @include('temps.forms.submit',['input' => trans('botao.Deletar'), 'attr' => ['class' => 'btn btn-danger']])
                        {!! Form::close() !!}
                    </div>
                </div>
                @endif
			</div>
		</div>
	</div>
</div>

@endsection
