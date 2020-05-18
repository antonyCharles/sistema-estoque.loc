<div class="form-group">
	<label for="{{ $input }}"><b>{{ $label ?? $input ?? "ERRO" }}:</b></label>
	{!! Form::select($input, $list, $value ?? null, $attr ?? null); !!}
	<div class="invalid-feedback">
		@lang('global.selecioneItem')
	</div>
</div>