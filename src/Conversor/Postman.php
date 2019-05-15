<?php
namespace Phppostman\Conversor;

class Postman
{
    public function __construct()
    {
    }

    public function converter($ds_informacao)
    {
        $arrLinhas = explode("\n", $ds_informacao);
        $arrIndices = $this->getLinhasIndices($arrLinhas);

        $ds_url = $this->getValorRange(
            $arrLinhas,
            $arrIndices,
            '##url:',
            '##metodo:'
        );

        $ds_metodo = $this->getValorRange(
            $arrLinhas,
            $arrIndices,
            '##metodo:',
            '##headers:'
        );

        $ds_headers = $this->getValorRange(
            $arrLinhas,
            $arrIndices,
            '##headers:',
            '##json:',
            true
        );

        $ds_json = $this->getValorRange(
            $arrLinhas,
            $arrIndices,
            '##json:',
            '##fim:',
            true
        );

        $arrHeaders = $this->processHeaders($ds_headers);

        return [
            'ds_url' => $ds_url,
            'ds_metodo' => $ds_metodo,
            'arrHeaders' => $arrHeaders,
            'ds_json' => $ds_json
        ];
    }

    private function getLinhasIndices($arrLinhas)
    {
        $arrIndices = array(
            '##null' => null,
            '##url:' => null,
            '##metodo:' => null,
            '##headers:' => null,
            '##json:' => null
        );

        foreach ($arrLinhas as $nr_linha => $ds_linha) {
            $ds_linha = trim($ds_linha);

            $nr_linha_key = array_search(
                $ds_linha,
                array_keys($arrIndices)
            );

            if ($nr_linha_key != null && $nr_linha_key != false) {
                $arrIndices[$ds_linha] = $nr_linha;
            }
        }

        return $arrIndices;
    }

    private function getValorRange(
        $arrLinhas,
        $arrIndices,
        $ds_str_de,
        $ds_str_ate,
        $sn_enter = false
    ) {
        $nr_inicio = ($arrIndices[$ds_str_de] + 1);

        if ($ds_str_ate != '##fim:') {
            $nr_fim = ($arrIndices[$ds_str_ate] - 1);
        }

        if ($ds_str_ate == '##fim:') {
            $nr_fim = count($arrLinhas) - 1;
        }

        $ds_string = '';

        $ds_enter = "";

        if ($sn_enter == true) {
             $ds_enter = "\n";
        }

        for ($i = $nr_inicio; $i <= $nr_fim; $i++) {
            $ds_string = $ds_string . $arrLinhas[$i] . $ds_enter;
        }

        return trim($ds_string);
    }

    private function processHeaders(
        $ds_headers
    ) {
        $arrLinhas = explode("\n", $ds_headers);
        $arrHeader = [];

        foreach ($arrLinhas as $ds_linha) {
            if (strpos($ds_linha, ':')) {
                list($ds_nome, $ds_valor) = explode(':', $ds_linha);
                if ($ds_nome != null) {
                    $arrHeader[$ds_nome] = $ds_valor;
                }
            }
        }

        return $arrHeader;
    }
}
