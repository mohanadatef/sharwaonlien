<?php

namespace App\Imports;

use App\Models\TempletPricesDelivery;
use Maatwebsite\Excel\Concerns\ToModel;

class TempletPricesDeliveryImport implements ToModel
{
    public function model(array $row)
    {
        return new TempletPricesDelivery([
            'company_delivery' => $row[0],
            'city'       => $row[1],
            'area'       => $row[2],
            'prices'       => $row[3],
            ]);
    }
}
