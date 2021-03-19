<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Book extends Model {

    /**
   * Связанная с моделью таблица.
   *
   * @var string
   */
  protected $table = 'my_books';

  public $timestamps = false;
}

