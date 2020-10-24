<?php

namespace App\Services;

use App\Repositories\Interfaces\IOrderRepository;
use Carbon\Carbon;

class DashboardService{
    protected $orders;

    public function __construct(IOrderRepository $orders){
        $this->orders = $orders;
    }

    public function chartSales(){
        $salePerMonth = [0,0,0,0,0,0,0,0,0,0,0,0];
        $result = $this->orders->all();
        foreach($result as $data)
            $salePerMonth[(int)Carbon::parse($data->created_at)->format('m')-1]++;
        return $salePerMonth;
    }
}