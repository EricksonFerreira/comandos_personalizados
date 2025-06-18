<?php

namespace App\Http\Controllers\Interfaces;

interface FiltroInterface
{

    function configurarSessao();
    function obterFiltrosPrincipais();
    function obterFiltrosSecundarios();

}
