<div class="form-group">
  <label class="control-label" for="{{ $id }}">{{ $label }}</label>
  <input type="{{ $type ?? 'text'}}" class="form-control underlined {{ $class ?? ''}}" id="{{ $id }}" placeholder="{{ $placeholder }}" name="{{ $id }}" value="{{ $value ?? $nonValue ?? ''}}">
</div>
