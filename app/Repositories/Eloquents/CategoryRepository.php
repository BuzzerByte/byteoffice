<?php

namespace App\Repositories\Eloquents;

use App\Category;
use Auth;
use App\Repositories\Interfaces\ICategoryRepository;

class CategoryRepository implements ICategoryRepository{
    protected $categories;

    public function __construct(
        Category $categories
    ){
        $this->categories = $categories;
    }

    public function all(){
        return $this->categories->where('user_id',Auth::user()->id)
                                ->orderBy('created_at', 'asc')
                                ->get();
    }
}