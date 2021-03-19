<?php

namespace App\View;

use App\Exception\NotFoundException;
use App\Interfaces\Renderable;

class View implements Renderable
{
    private $path;
    private $data;
    private $page;

    public function __construct(string $path, array $data = [])
    {
        $this->path = setNormalSlashes(VIEW_DIR . DIRECTORY_SEPARATOR . str_replace('.', DIRECTORY_SEPARATOR, $path) . '.php');
        $this->data = $data;
    }

    public function render()
    {
        if (file_exists($this->path)) {
            ob_start();
            extract($this->data);
            require_once $this->path;
            $this->page = ob_get_clean();
        } else {
            throw new NotFoundException('Файл шаблона ' . $this->path . ' не существует');
        }

        echo $this->page;
    }
}
