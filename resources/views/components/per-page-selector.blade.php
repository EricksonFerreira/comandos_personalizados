<div class="d-flex flex-row align-items-end mr-2">
    <label for="perPage" class="text-xs font-weight-normal mr-2" style="margin:0px;color:#6c757d">Itens Página</label>
    <select name="perPage" id="perPage" class="form-control form-control-sm p-0" onchange="this.form.submit()"
        style="
    padding:0px;height:1.3rem;width:3rem">
        @foreach ($perPages as $perPage)
            <option value="{{ $perPage }}" {{ $perPage == $selectedPerPage ? 'selected' : '' }}>{{ $perPage }}
            </option>
        @endforeach
    </select>
</div>
