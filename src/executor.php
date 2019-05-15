<?php
require '../vendor/autoload.php';

use Phppostman\Arquivo\FileRead;
use Phppostman\Conversor\Postman;
use Phppostman\Http\Guzzle;

$objPostman = new Postman();
$objGuzzle = new Guzzle();

$ds_api = $_REQUEST['api'];
$ds_path = '../api/' . $ds_api;

$ds_content = FileRead::lerArquivo($ds_path);

$arrDados = $objPostman->converter($ds_content);

$objGuzzle->setUrl(
    $arrDados['ds_url']
)->setArrHeaders(
    $arrDados['arrHeaders']
)->setJson(
    $arrDados['ds_json']
);

$resultado = $objGuzzle->executar(
    $arrDados['ds_metodo']
);


echo $resultado;