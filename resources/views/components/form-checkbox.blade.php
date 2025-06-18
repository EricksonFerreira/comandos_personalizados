<!-- resources/views/components/form-checkbox.blade.php -->
@props(['name', 'label', 'checked' => false])

<div class="form-check">
    <input type="checkbox" class="form-check-input" id="{{ $name }}" name="{{ $name }}" {{ $checked ? 'checked' : '' }}>
    <label class="form-check-label" for="{{ $name }}">{{ $label }}</label>
</div>
