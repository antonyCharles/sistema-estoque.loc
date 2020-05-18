@if(session()->has('msg-redirect-sucesso'))
<div class="row">
	<div class="col-12 col-sm-12">
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		    <b>{{ session('msg-redirect-sucesso') }}</b>
		    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
		        <span aria-hidden="true">×</span>
		    </a>
		</div>
	</div>
</div>
@endif

@if(session()->has('msg-redirect-erro'))
<div class="row">
	<div class="col-12 col-sm-12">
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
		    <b>{{ Session::pull('msg-redirect-erro','default') }}</b>
		    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
		        <span aria-hidden="true">×</span>
		    </a>
		</div>
	</div>
</div>
@endif

@if(session()->has('msg-redirect-aviso'))
<div class="row">
	<div class="col-12 col-sm-12">
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
		    <b>{{ Session::pull('msg-redirect-aviso','default') }}</b>
			<hr/>
		    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
		        <span aria-hidden="true">×</span>
		    </a>
		</div>
	</div>
</div>
@endif

@if(count($errors) > 0)
<div class="row">
	<div class="col-12 col-sm-12">
		<div class="alert alert-danger">
			<b>@lang('msgErros.TitleAlert')</b>
		    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
		        <span aria-hidden="true">×</span>
		    </a>
			<hr/>
			<ul>
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>
@endif