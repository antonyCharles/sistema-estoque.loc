<div class="item form-group">
    {!! Form::text(
        $input,
        $value ?? null,
        $attr ?? null) !!}
        <div class="invalid-feedback">
		  @lang('label.fillInput')
	    </div>
</div>