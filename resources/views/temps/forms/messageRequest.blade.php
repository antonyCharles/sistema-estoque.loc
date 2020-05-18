@if(count($errors) > 0)
<div class="row">
	<div class="col-12 col-sm-12">
		<div class="alert alert-danger">
			<b>@lang('global.alertErroForm')</b>
			<ul>
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>
@endif