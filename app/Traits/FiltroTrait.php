<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait FiltroTrait
{

    /**
     * Cria filtros de sessão de forma dinâmica.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $nomeFiltro
     * @param string $urlPadrao
     * @return void
     */
    private function criarFiltros(Request $request, string $nomeFiltro)
    {
        session()->forget("$nomeFiltro.filtro");

        $filtros = $request->all();
        foreach ($filtros as $chave => $valor) {
            if ($valor !== null && !in_array($chave, ['nomeFiltro', 'urlPadrao', 'routeRedirect'])) {

                // Formata o nome para exibição
                $nomeExibir = $this->formatarNomeExibir($chave);

                // Determina o tipo de filtro e o nome do campo sem sufixo
                [$chave, $typeWhere] = $this->determinarTipoFiltro($chave);


                session(["$nomeFiltro.filtro.$chave" => [
                    'url' => session()->get($nomeFiltro . '.urlPadrao') . '/removerfiltro?' . $chave . '=1',
                    'name' => $chave,
                    'nomeExibir' => $nomeExibir,
                    'valor' => $valor,
                    'typeWhere' => $typeWhere,
                ]]);
            }
        }
    }

    /**
     * Remove filtros de sessão.
     *
     * @param string $sessao
     * @param string|null $atributo
     * @return void
     */
    public function removeSessao(string $sessao, string $atributo = null)
    {
        $atributo = $atributo ? ".$atributo" : '';
        session()->forget("$sessao.filtro$atributo");
    }

    public function redirecionaRotaRedirect(string $nomeFiltro, string $mensagem = 'Não há rota de redirecionamento', string $tipo = 'success')
    {
        // dd(session()->has($nomeFiltro . '.rotaRedirect'),$mensagem);
        if (session()->has($nomeFiltro . '.rotaRedirect')) {
            return redirect()->route(session($nomeFiltro . '.rotaRedirect'));
        }

        if ($mensagem) {
            return redirect()->back()->with($tipo, $mensagem);
        }

        return redirect()->back();
    }

    private function determinarTipoFiltro(string $chave): array
    {
        $typeWhere = 'where';
        if (str_ends_with($chave, '_like')) {
            $typeWhere = 'like';
            $chave = str_replace('_like', '', $chave);
        } elseif (str_ends_with($chave, '_where')) {
            $chave = str_replace('_where', '', $chave);
        }
        return [$chave, $typeWhere];
    }

    private function formatarNomeExibir($chave) {
        // Caso seja Snake_Case, CamelCase ou PascalCase separe por espaço
        $nomeExibir = preg_replace('/(?<!^)([A-Z])/', ' $1', ucfirst($chave));
        // Altera o _ por ' ' e remove '_where' e '_like'
        $nomeExibir = str_replace(['_where', '_like', '_'], ' ', $nomeExibir);
        // Remove todas as variações de "id" se estiver isolada
        $nomeExibir = preg_replace('/\b(id|Id|iD|ID)\b/i', '', $nomeExibir);
        // Capitaliza a primeira letra de cada palavra
        $nomeExibir = ucwords($nomeExibir);

        return $nomeExibir;
    }

      public static function formatOptions($items, $defaultLabel = 'Selecione uma opção')
    {
        $options = [];
        $options[] = ['value' => '', 'label' => $defaultLabel, 'selected' => false];

        foreach ($items as $key => $value) {
            $options[] = ['value' => $key, 'label' => $value, 'selected' => false];
        }

        return $options;
    }
}
