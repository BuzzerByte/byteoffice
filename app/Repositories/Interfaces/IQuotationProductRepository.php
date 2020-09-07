<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
use App\QuotationProduct;

interface IQuotationProductRepository
{
    public function store($inventories, $quotation_id);
    public function getByQuotationId($quotation_id);
    public function update($inventories, $quotation_id);
}