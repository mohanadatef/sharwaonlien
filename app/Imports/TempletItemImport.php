<?php

namespace App\Imports;

use App\Models\TempletItem;
use Maatwebsite\Excel\Concerns\ToModel;

class TempletItemImport implements ToModel
{
    public function model(array $row)
    {
        return new TempletItem([
            'bag'       => $row[0],
            'brand'       => $row[1],
            'size'       => $row[2],
            'category_type'  => $row[3],
            'type'       => $row[4],
            'color'       => $row[5],
         /*   'gender'       => $row[6],*/
            'weight'       => $row[6],
            'height_item'       => $row[7],
            'width_item'       => $row[8],
            'image_main'       => $row[9],
            'cost'       => $row[10],
            'price'       => $row[11],
            'location'       => $row[12],
            'discount'       => $row[13],
   /*         'order'       => $row[11],*/
            ]);
    }
}
