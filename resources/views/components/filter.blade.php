@props(['additionalFilters', 'filters', 'filteredItems', 'itensFiltered'])
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="card">
    <div class="card-body p-2">
        <h5 class="text-secondary text-xs"><i class="fa fa-filter text-xs"></i> Filtros</h5>
        <hr class="m-0 mb-1">
        <form method="GET" action="{{ url()->current() }}/filtro">
            <div class="row">
                @foreach ($filters as $filter)
                    <div class="form-group col">
                        <label for="{{ $filter['name'] }}" class="d-block">{{ $filter['label'] }}</label>
                        @if (isset($filter['options']))
                            <select class="form-control form-control-sm" id="{{ $filter['name'] }}"
                                name="{{ $filter['name'] }}_{{$filter['typeWhere'] ?? 'where'}}">
                                @foreach ($filter['options'] as $option)
                                    <option value="{{ $option['value'] }}"
                                        {{ isset($option['selected']) ? ($option['selected'] ? 'selected' : '') : '' }}>
                                        {{ $option['label'] }}
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <input type="text" class="form-control form-control-sm" id="{{ $filter['name'] }}"
                                name="{{ $filter['name'] }}_{{$filter['typeWhere'] ?? 'where'}}" placeholder="{{ $filter['label'] }}"
                                value="{{ $filter['valor'] ?? '' }}">
                        @endif
                    </div>
                @endforeach
                <div class="form-group col d-flex align-items-end">
                    <div class="d-flex">
                        @if (isset($additionalFilters) && is_array($additionalFilters) && count($additionalFilters) > 0)
                            <a id="toggle-filters" data-toggle="tooltip" title="Exibir filtros adicionais"
                                class="rounded-circle border px-2 p-1 mr-2" style="cursor: pointer">
                                <i class="fa fa-angle-double-down"></i>
                            </a>
                        @endif
                        <button type="submit" class="btn btn-sm btn-primary">Filtrar</button>
                    </div>
                </div>
            </div>

            <div id="additional-filters" class="row border p-1 rounded mx-1" style="display: none;">
                <div class="d-flex flex-column">
                    <p class="py-0 mb-0  text-xs text-secondary text-bold"><u>Itens Adicionais do filtro:</u></p>
                    <div class="row">

                        @foreach ($additionalFilters as $filter)
                            <div class="form-group col">
                                <label for="{{ $filter['name'] }}" class="d-block">{{ $filter['label'] }}</label>
                                @if (isset($filter['options']))
                                    <select class="form-control form-control-sm" id="{{ $filter['name'] }}"
                                        name="{{ $filter['name'] }}_{{$filter['typeWhere'] ?? 'where'}}">
                                        @foreach ($filter['options'] as $option)
                                            <option value="{{ $option['value'] }}"
                                                {{ isset($option['selected']) ? ($option['selected'] ? 'selected' : '') : '' }}>
                                                {{ $option['label'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="text" class="form-control form-control-sm"
                                        id="{{ $filter['name'] }}" name="{{ $filter['name'] }}_{{$filter['typeWhere'] ?? 'where'}}"
                                        placeholder="{{ $filter['label'] }}"
                                        value="{{ request($filter['name']) ?? ($filter['valor'] ?? '') }}">
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Campos ocultos para enviar os dados adicionais -->
            <input type="hidden" name="urlPadrao" value="{{ session()->get($nomeFiltro . '.urlPadrao') }}">
            <input type="hidden" name="routeRedirect" value="{{ session()->get($nomeFiltro . '.rotaRedirect') }}">

        </form>

        @if (isset($itensFiltered) && count($itensFiltered) > 0)
            <div class="mt-1">
                <h6 class="text-xs text-secondary text-bold"><u>Filtros Aplicados:</u></h6>
                @foreach ($itensFiltered as $filter)
                    @if ($filter['valor'])
                        <div class="d-inline-block mr-2">
                            <form action="{{ $filter['url'] }}" method="GET">
                                <input type="hidden" name="sessao" value="{{ $nomeFiltro }}">
                                <input type="hidden" name="atributo" value="{{ $filter['name'] }}">
                                <button type="submit"
                                    class="badge badge-secondary font-weight-normal text-white border-0">
                                    <span class="text-white mr-1">
                                        &times;
                                    </span>
                                    <b class="text-capitalize">{{ $filter['nomeExibir'] }}</b>
                                     {{-- {{ $filter['valor'] }} --}}
                                </button>
                            </form>
                        </div>
                    @endif
                @endforeach
                <div class="">
                    <form action="{{ url()->current() }}/removerfiltro" method="GET">
                        <button type="submit" class="badge badge-danger border-0 font-weight-normal">
                            <span class="text-white mr-1">
                                &times;
                            </span>
                            <b>Limpar Todos os Filtros</b>
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            width: '100%',
            theme: 'bootstrap4',
            placeholder: 'Selecione uma opção',
            allowClear: true
        });

        // Inicializa o tooltip
        $('#toggle-filters').tooltip();

        $('#toggle-filters').on('click', function() {
            var additionalFilters = $('#additional-filters');
            if (additionalFilters.is(':visible')) {
                additionalFilters.slideUp('fast');
                $(this).html('<i class="fa fa-angle-double-down"></i>');
                $(this).attr('title', 'Exibir filtros adicionais').tooltip('dispose').tooltip();
            } else {
                additionalFilters.slideDown('fast');
                $(this).html('<i class="fa fa-angle-double-up"></i>');
                $(this).attr('title', 'Ocultar filtros adicionais').tooltip('dispose').tooltip();
            }
        });
    });
</script>
