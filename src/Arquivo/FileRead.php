<?php
namespace Phppostman\Arquivo;

class FileRead
{
    public function __construct()
    {

    }


    public static function lerArquivo($data)
    {
        if (!file_exists($data)) {
            return null;
        }

        return file_get_contents($data);
    }
}
