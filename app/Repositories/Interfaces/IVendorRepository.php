<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
use App\Vendor;

interface IVendorRepository
{
    public function all($user_id);
    public function store($auth_id, Request $request);
    public function import($auth_id, Request $request);
    public function show(Vendor $vendor);
    public function edit(Vendor $vendor);
    public function update(Request $request, Vendor $vendor);
    public function destroy(Vendor $vendor);
}