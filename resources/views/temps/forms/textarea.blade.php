<div class="form-group">
	<label for="{{ $input }}">{{ $label ?? $input ?? "ERRO" }}:</label>
	<textarea name="{{ $input }}" class="form-control" id="{{ $input }}" rows="3">{{ $value ?? null }}</textarea>
</div>