<?php
namespace Phppostman\Http;


class Guzzle
{

    private $ds_url;
    private $ds_metodo;
    private $arrHeaders;
    private $ds_json;

    public function __construct()
    {
       $this->ds_url = '';
       $this->ds_metodo = '';
       $this->arrHeaders = '';
       $this->ds_json = '';
    }

    public function setUrl($ds_valor)
    {
        $this->ds_url = $ds_valor;
        return $this;
    }

    public function setArrHeaders($arrValor)
    {
        $this->arrHeaders = $arrValor;
        return $this;
    }

    public function setJson($ds_valor)
    {
        $this->ds_json = $ds_valor;
        return $this;
    }

    public function executar($ds_metodo)
    {
        $objGuzzleClient = new \GuzzleHttp\Client(
            [
                'headers' => $this->arrHeaders,
                'json' => $this->ds_json,
            ]
        );

        if ($ds_metodo == 'get') {
            $objResponse = $objGuzzleClient->get(
                $this->ds_url
            );

            $ds_content = $objResponse->getBody()
                ->getContents();

            return $ds_content;
        }
    }
}
