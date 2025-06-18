<?php
namespace App\Traits;
trait AtualizaFiltrosTrait
{
    public function atualizarFiltros(array &$itensFiltrados, array &$filtros)
    {
        foreach ($itensFiltrados as $key => &$item) {
            foreach ($filtros as &$filtro) {
                if ($filtro['name'] === $item['name']) {
                    if ($filtro['type'] === 'text') {
                        $filtro['valor'] = $item['valor'];
                    } elseif ($filtro['type'] === 'select') {
                        foreach ($filtro['options'] as &$opcao) {
                            if ($opcao['value'] == $item['valor']) {
                                $opcao['selected'] = true;
                            }
                        }
                        unset($opcao); // Remove a referência para evitar problemas potenciais
                    }
                }
            }
            unset($filtro); // Remove a referência para evitar problemas potenciais
        }
        unset($item); // Remove a referência para evitar problemas potenciais
    }
}
