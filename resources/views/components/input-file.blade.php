<div class="custom-file">
    {{-- Custom file input --}}
    <input type="file" id="{{ $id }}" name="{{ $name }}"
        {{ $attributes->merge(['class' => 'custom-file-input']) }} @if($required) required @endif>

    {{-- Custom file label --}}
    <label class="custom-file-label text-truncate" for="{{ $id }}"
        @isset($legend) data-browse="{{ $legend }}" @endisset>
        {{ $placeholder }}
    </label>
</div>

@once
@push('js')
<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
</script>
@endpush
@endonce

@once
@push('css')
<style type="text/css">
    {{-- SM size setup --}}
    .input-group-sm .custom-file-label:after {
        height: 1.8125rem;
        line-height: 1.25;
    }
    .input-group-sm .custom-file-label {
        height: calc(1.8125rem + 2px);
        line-height: 1.25;
    }
    .input-group-sm .custom-file {
        height: calc(1.8125rem + 2px);
        font-size: .875rem;
    }

    {{-- LG size setup --}}
    .input-group-lg .custom-file-label:after {
        height: 2.875rem;
        line-height: 1.6;
    }
    .input-group-lg .custom-file-label {
        height: calc(2.875rem + 2px);
        line-height: 1.6;
    }
    .input-group-lg .custom-file {
        height: calc(2.875rem + 2px);
        font-size: 1.25rem;
    }
</style>
@endpush
@endonce
