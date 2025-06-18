<ol class="breadcrumb page_bradcam mb-0">
    @foreach ($breadcrumbs as $breadcrumb)
        <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
            @if (!$loop->last)
                <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
            @else
                {{ $breadcrumb['name'] }}
            @endif
        </li>
    @endforeach
</ol>
