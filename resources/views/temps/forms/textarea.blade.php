<div class="form-group">
	<label for="{{ $input }}"><b>{{ $label ?? $input ?? "ERRO" }}:</b></label>
	<textarea name="{{ $input }}" class="form-control" id="{{ $input }}" rows="3">{{ $value ?? null }}</textarea>
</div>