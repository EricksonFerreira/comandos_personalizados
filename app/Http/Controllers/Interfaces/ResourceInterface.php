<?php

namespace App\Http\Controllers\Interfaces;

use App\Http\Requests\RequestInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

interface ResourceInterface
{
    public function index();
    public function create();
    // public function store($request);
    // public function update($request, $id);
    public function destroy($id);
    public function filtro(Request $request);
    public function removerFiltro(Request $request);
    public function setPerPage(Request $request);
}
