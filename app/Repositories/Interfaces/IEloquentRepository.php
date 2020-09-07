<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

/**
* Interface EloquentRepositoryInterface
* @package App\Repositories
*/
interface IEloquentRepository
{
   /**
    * @param array $attributes
    * @return Model
    */
   public function create(array $attributes): Model;

   /**
    * @param $id
    * @return Model
    */
   public function find($id): ?Model;
}