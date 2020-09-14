<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface IEmployeeRepository {
    public function all();
    public function store(Request $request, $file_name);
}