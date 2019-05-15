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
        if ($ds_metodo == 'get') {
            $objGuzzleClient = new \GuzzleHttp\Client(
                [
                    'headers' => $this->arrHeaders,
                    'json' => $this->ds_json,
                ]
            );

            $objResponse = $objGuzzleClient->get(
                $this->ds_url
            );

            $ds_content = $objResponse->getBody()
                ->getContents();

            return $ds_content;
        }

        if ($ds_metodo == 'post') {
            $objGuzzleClient = new \GuzzleHttp\Client(
                [
                    'headers' => $this->arrHeaders,
                     'json' => \GuzzleHttp\json_decode($this->ds_json)
                ]
            );

            /// $objGuzzleClient->setBody(json_encode($this->ds_json));

            $objResponse = $objGuzzleClient->post(
                $this->ds_url
            );

            $ds_content = $objResponse->getBody()
                ->getContents();

            return $ds_content;
        }

        return 'sem-resposta';
    }
}
