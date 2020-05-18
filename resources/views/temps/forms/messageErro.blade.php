@if(isset($success))
<div class="row">
	<div class="col-12 col-sm-12">
		<div class="alert {{ session('success') ? 'alert-success' : 'alert-danger' }}  alert-dismissible fade show" role="alert">
		    <strong>{{ $message ?? trans('global.erroMessage') }}</strong>
		    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
		        <span aria-hidden="true">×</span>
		    </a>
		</div>
	</div>
</div>
@endif