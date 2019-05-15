<?php
namespace PhpFlo\Component\Http;

use PhpFlo\Common\ComponentInterface;
use PhpFlo\Common\ComponentTrait;

class Guzzle implements ComponentInterface
{
    use ComponentTrait;

    private $ds_url;
    private $ds_metodo;
    private $arrHeaders;
    private $ds_json;

    public function __construct()
    {
        $this->inPorts()
            ->add(
                'ds_url',
                ['datatype' => 'string']
            )->add(
                'arrHeaders',
                ['datatype' => 'array']
            )->add(
                'ds_json',
                ['datatype' => 'string']
            )->add(
                'ds_metodo',
                ['datatype' => 'string']
            );

        $this->outPorts()
            ->add(
                'ds_json',
                ['datatype' => 'string']
            );

        $this->inPorts()
            ->ds_url
            ->on(
                'data',
                [$this, 'setUrl']
            );

        $this->inPorts()
            ->arrHeaders
            ->on(
                'data',
                [$this, 'setArrHeaders']
            );

        $this->inPorts()
            ->ds_json
            ->on(
                'data',
                [$this, 'setJson']
            );

        $this->inPorts()
            ->ds_metodo
            ->on(
                'data',
                [$this, 'executar']
            );
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
          
            $this->outPorts()
                ->ds_json
                ->send($ds_content)
                ->disconnect();
        }        
    }
}
