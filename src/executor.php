<?php
require '../vendor/autoload.php';

use Phppostman\Arquivo\FileRead;

$ds_api = $_REQUEST['api'];
$ds_path = '../api/' . $ds_api;

dump($ds_path);

$ds_content = FileRead::lerArquivo($ds_path);

dump($ds_content);

