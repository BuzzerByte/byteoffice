<?php

namespace App\Imports;

use App\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClientsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Client([
            'name' => $row['name'],
            'company'=> $row['company'],
            'phone'=> $row['phone'],
            'fax'=> $row['fax'],
            'email'=> $row['email'],
            'website'=> $row['website'],
            'billing_address'=> $row['billing_address'],
            'shipping_address'=> $row['shipping_address'],
            'note'=> $row['note']
        ]);
    }
}
