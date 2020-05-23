<div class="item form-group">
    {!! Form::select($input, $list ?? [], $value ?? null, $attr ?? null); !!}
    <div class="invalid-feedback">
		@lang('label.selectItem')
	</div>
</div>