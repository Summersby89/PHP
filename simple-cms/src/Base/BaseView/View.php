<?php

namespace App\Base\BaseView;

use App\Interfaces\Renderable;
use Exception;

class View implements Renderable
{
    /** Дефолтный шаблон  */
    const LAYOUT = DEFAULT_LAYOUT;

    /**
     * Подключаемый шаблон
     * @var string $view
     */
    public $view;

    /**
     * Массив с данными для подключаемого шаблона
     *
     * @var array $data
     */
    public $data;

    /**
     * Дефолтный шаблон
     * @fixme переделать и дать возможность подключать желаемый шаблон
     *
     * @var string $layout
     */
    public $layout;

    public function __construct($view, $data = [])
    {
        $this->view = $view;
        $this->data = $data;
        $this->layout = static::LAYOUT;
    }

    public function render()
    {
        if (is_array($this->data)) {
            extract($this->data);
        }
        $viewFile = VIEW_DIR . str_replace('.', '/', $this->view) . '.php';
        if (file_exists($viewFile)) {
            ob_start();
            require $viewFile;
            $content = ob_get_clean();
        } else {
            throw new Exception("На найден вид {$viewFile}", 500);
        }

        if (is_file($this->layout)) {
            require $this->layout;
        } else {
            throw new Exception("На найден шаблон {$this->layout}", 500);
        }
    }
}