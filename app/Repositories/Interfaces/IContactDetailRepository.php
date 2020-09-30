<?php

namespace App\Repositories\Interfaces;

interface IContactDetailRepository {
    public function checkContactDetailExists($id);
    public function getContactDetailById($id);
    public function storeContactDetailById($id);
}