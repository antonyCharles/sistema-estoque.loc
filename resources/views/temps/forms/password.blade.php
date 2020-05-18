<div class=”form-group”>
	<label for="{{ $input }}">
		<span>{{ $label ?? $input ?? "ERRO" }}:</span>
	</label>
	{!! Form::password($input, $attr ?? null) !!}
	<div class="invalid-feedback">
		@lang('global.prencherCampo')
	</div>
</div>