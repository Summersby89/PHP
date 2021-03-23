<?php

namespace App\Controllers;

use App\Base\BaseController\Controller;
use App\Base\BaseView\View;
use App\Model\Book;

class MainController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $title = 'Моя библиотека';
        return new View('index', compact('books', 'title'));
    }

    public function about()
    {
        return new View('about.index', ['title' => 'About Page']);
    }

    public function test1($params)
    {
        var_dump($params);
    }

    public function test2($params1, $params2)
    {
        var_dump($params1);
        var_dump((int)$params2);
    }

    public function test3()
    {

    }
}
