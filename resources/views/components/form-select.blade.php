@if($floating) <div class="form-floating"> @endif

    @if(!$floating)
    <x-form-label :label="$label" :for="$attributes->get('id') ?: $id()" :required="$attributes->has('required')" />
        @endif

    <select
        name="{{ $name }}"

        @if($multiple)
            multiple
        @endif

        @if($placeholder)
            placeholder="{{ $placeholder }}"
        @endif

        @if($label && !$attributes->get('id'))
            id="{{ $id() }}"
        @endif

        {!! $attributes->merge(['class' => 'form-select' . (isset($hasError) && $hasError($name) ? ' is-invalid' : '')]) !!}
    >

        @if($placeholder)
            <option value="" disabled @if($nothingSelected()) selected="selected" @endif>
                {{ $placeholder }}
            </option>
        @endif

        @forelse($options as $key => $option)
            <option value="{{ $key }}" @if($isSelected($key)) selected="selected" @endif>
                {{ $option }}
            </option>
        @empty
            {!! $slot !!}
        @endforelse
    </select>

    @if($floating)
        <x-form-label :label="$label" :for="$attributes->get('id') ?: $id()" />
    @endif

@if($floating) </div> @endif

{!! $help ?? null !!}

@php
    $hasErrorAndShow = function($name) {
        return session()->has('errors') && session('errors')->has($name);
    };
@endphp

@if($hasErrorAndShow($name))
    <x-form-errors :name="$name" />
@endif
