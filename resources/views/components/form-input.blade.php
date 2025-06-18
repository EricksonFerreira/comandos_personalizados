@if(isset($type) && $type === 'hidden') <div class="d-none"> @endif
    @if(isset($floating) && $floating) <div class="form-floating"> @endif

        @if(!isset($floating) || !$floating)
            <x-form-label :label="$label" :for="$attributes->get('id') ?: $id()" :required="$attributes->has('required')" />
        @endif

        <input
            {!! $attributes->merge(['class' => 'form-control' . (isset($type) && $type === 'color' ? ' form-control-color' : '') . (isset($hasError) && $hasError($name) ? ' is-invalid' : '')]) !!}

            type="{{ $type }}"

            @if(isset($isWired) && $isWired())
                wire:model{!! $wireModifier() !!}="{{ $name }}"
            @else
                value="{{ old($name, $value ?? (isset($type) && $type === 'color' ? '#000000' : '')) }}"
            @endif

            name="{{ $name }}"

            @if(isset($label) && $label && !$attributes->get('id'))
                id="{{ $id() }}"
            @endif

            {{--  Placeholder is required as of writing  --}}
            @if(isset($floating) && $floating && !$attributes->get('placeholder'))
                placeholder="&nbsp;"
            @endif
        />

        @if(isset($floating) && $floating)
            <x-form-label :label="$label" :for="$attributes->get('id') ?: $id()" :required="$attributes->has('required')" />
        @endif

    @if(isset($floating) && $floating) </div> @endif

    {!! $help ?? null !!}

    @if($errors->has($name))
    <x-form-errors :name="$name"  :message="$errors->first($name)" />
@endif

    @if(isset($type) && $type === 'hidden') </div> @endif
