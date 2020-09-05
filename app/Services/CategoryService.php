<?php


namespace App\Services;

use App\Category;
use App\Repositories\Interfaces\ICategoryRepository;

class CategoryService{
    public $categories;

    public function __construct(
        ICategoryRepository $categories
    ){
        $this->categories = $categories;
    }

    public function all(){
        $this->categories->all();
    }
}