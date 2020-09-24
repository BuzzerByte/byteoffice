<?php

namespace App\Repositories\Interfaces;

interface IEmployeeCommencementRepository{
    public function checkCommencementExists($id);
    public function getCommencementById($id);
    public function storeCommencementById($id);
}