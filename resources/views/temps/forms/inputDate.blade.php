<div class=”form-group”>
	<label for="{{ $input }}"><b>{{ $label ?? $input ?? "ERRO" }}:</b></label>
	{!! Form::date($input,$value ?? null, $attr ?? null) !!}
	<div class="invalid-feedback">
		@lang('global.prencherCampo')
	</div>
</div>