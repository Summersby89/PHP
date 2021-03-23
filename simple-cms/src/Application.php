<?php

namespace App;

use App\Exception\NotFoundException;
use App\Interfaces\Renderable;
use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;

class Application
{
    private $router;

    /**
     * Application constructor.
     *
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
        $this->initialize();
    }

    /**
     * @param NotFoundException $e
     * @return string
     * @throws Exception
     */
    public function renderException(NotFoundException $e)
    {
        if ($e instanceof Renderable) {
            return $e->render();
        } else {
            $e->errorCode = $e->getCode() ? $e->getCode() : 500;
            echo $e->getMessage();
        }
    }

    public function run()
    {
        try {
            $data = $this->router->dispatch($this);
            if ($data instanceof Renderable) {
                $data->render();
            } else {
                echo $data;
            }
        } catch (NotFoundException $e) {

            return $this->renderException($e);
        }
    }

    protected function initialize()
    {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => Config::getInstance()->get('host'),
            'database'  => Config::getInstance()->get('DBName'),
            'username'  => Config::getInstance()->get('userName'),
            'password'  => Config::getInstance()->get('userPassword'),
            'charset'   => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix'    => '',
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}
