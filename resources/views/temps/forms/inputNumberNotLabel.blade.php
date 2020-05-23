<div class="item form-group">
    {!! Form::number(
        $input,
        $value ?? null,
        $attr ?? null) !!}
        <div class="invalid-feedback">
		  @lang('label.fillInput')
	    </div>
</div>