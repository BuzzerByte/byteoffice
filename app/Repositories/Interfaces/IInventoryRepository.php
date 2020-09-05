<?php

namespace App\Repositories\Interfaces; 



interface IInventoryRepository{
    public function all();
    public function getNameById($id);
}