@props(['label', 'for','required', 'class' => '', 'error' => ''])
@if ($label)
    <label {!! $attributes->merge(['class' => $class ? $class . ' text-xs' : 'text-xs']) !!}>
        {{ $label }}

        @if (isset($required) && $required == true)
            <span style="color: red;">*</span>
        @endif

        @if ($error && $errors->has($error))
            <x-form-errors :name="$error" :message="$errors->first($error)" />
        @endif
    </label>
@endif
