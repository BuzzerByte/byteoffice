<?php

namespace App\Repositories\Interfaces;

use Http\Illuminate\Request;

interface IApplicationRepository{
    public function all();
    public function store(Request $request);
    public function update(Request $request, $id);
    public function destroy($id);
}