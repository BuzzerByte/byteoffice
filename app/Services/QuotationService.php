<?php

namespace App\Services;

use App\Repositories\Interfaces\IQuotationRepository;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\IQuotationProductRepository;
use App\Repositories\Interfaces\IClientRepository;
use App\Repositories\Interfaces\IInventoryRepository;
use App\Quotation;
use App\Exports\QuotationExport;

class QuotationService{
    protected $quotations;
    protected $quotationProducts;
    protected $clients;
    protected $inventories;

    public function __construct(
        IQuotationRepository $quotations,
        IQuotationProductRepository $quotationProducts,
        IClientRepository $clients,
        IInventoryRepository $inventories
    ){
        $this->quotations = $quotations;
        $this->quotationProducts = $quotationProducts;
        $this->clients = $clients;
        $this->inventories = $inventories;
    }

    public function all(){
        return $this->quotations->all();
    }

    public function store(Request $request, $inventories){
        $quotation = $this->quotations->store($request);
        return $this->quotationProducts->store($inventories, $quotation['id']);
    }

    public function show(Quotation $quotation){
        $quotations = $this->quotations->show($quotation);
        $client = $this->clients->getById($quotation->client_id);
        $quotation_products = $this->quotationProducts->getByQuotationId($quotation->id);
        return ['quotation'=>$quotations, 'client'=>$client, 'quotation_products'=>$quotation_products];
    }

    public function edit(Quotation $quotation){
        $quotations = $this->quotations->edit($quotation);
        $client = $this->clients->getById($quotation->client_id);
        $quotation_products = $this->quotationProducts->getByQuotationId($quotation->id);
        $inventories = $this->inventories->all();
        return [
            'quotations'=>$quotations, 
            'client'=>$client, 
            'quotation_products'=>$quotation_products,
            'inventories' => $inventories
        ];
    }

    public function update(Request $request, Quotation $quotation, $inventories){
        $quotations = $this->quotations->update($request, $quotation);
        return $this->quotationProducts->update($inventories, $quotation->id);
    }

    public function destroy(Quotation $quotation){
        return $this->quotations->destroy($quotation);
    }

    public function exportQuotation(){
        return (new QuotationExport)->download('quotations.csv');
    }
}