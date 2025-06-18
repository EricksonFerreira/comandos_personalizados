<div class="d-flex justify-content-between align-items-center">
    <h3 class="mb-0 font-weight-bold">{{ $title }}</h3>
    @if(isset($createUrl) && $createUrl)
        <a href="{{ $createUrl }}" class="btn btn-xs btn-primary"><i class="fa fa-plus" style="font-size:10px"></i> Adicionar</a>
    @endif
</div>
