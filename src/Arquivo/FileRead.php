<?php
namespace PhpFlo\Component\Arquivo;

use PhpFlo\Common\ComponentInterface;
use PhpFlo\Common\ComponentTrait;

class FileRead implements ComponentInterface
{
    use ComponentTrait;

    public function __construct()
    {
        $this->inPorts()
            ->add(
                'ds_file_path',
                ['datatype' => 'string']
            );

        $this->outPorts()
            ->add(
                'out',
                ['datatype' => 'string']
            )
            ->add(
                'error',
                []
            );

        $this->inPorts()
            ->ds_file_path
            ->on(
                'data',
                [$this, 'lerArquivo']
            );
    }


    public function lerArquivo($data)
    {
        if (!file_exists($data)) {
            $this->outPorts()
                ->error
                ->send(
                    "File {$data} doesn't exist"
                );

            return;
        }

        $this->outPorts()
            ->out
            ->send(file_get_contents($data))
            ->disconnect();
    }
}
