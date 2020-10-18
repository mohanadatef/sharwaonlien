<?php

namespace App\Exports;

use App\Models\Item;
use App\Models\Item_Export;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ItemExport implements FromCollection, WithHeadings
{
    use Exportable;
    public function headings(): array
    {
        return ['bag','brand','description','supplier','type','size','color'
            ,'code','weight','cost','statues','statues_item_store'
            ,'price','net','discount','Minimum Price','last modified data','last modified time'];
    }

    public function __construct($start,$end)
    {
        $this->start =$start;
        $this->end=$end;

    }

   public function collection()
    {
        Item_Export::truncate();
        $item=Item::where('created_at', '>=', $this->start)->where('created_at', '<=', $this->end)->get();
        foreach ($item as $myitem)
        {
            $item_export=new Item_Export();
            $item_export->brand=$myitem->brand->name;
            $item_export->bag=$myitem->bag->name;
            $item_export->size=$myitem->size->name;
            $item_export->color=$myitem->color->name;
            $item_export->type=$myitem->type->name;
            $item_export->category_type=$myitem->category_type->name;
            $item_export->supplier=$myitem->supplier->name;
            $item_export->code=$myitem->code;
            $item_export->weight=$myitem->weight;
            $item_export->price=$myitem->price;
            $item_export->cost=$myitem->cost;
            $item_export->discount=$myitem->discount;
            $item_export->minimum_price=number_format((($myitem->bag->cost_profit /$myitem->bag->weight)/ 1000) * $myitem->weight,0);
            $y_end = Carbon::parse($myitem->updated_at)->format('20y');
            $m_end = Carbon::parse($myitem->updated_at)->format('m');
            $d_end = Carbon::parse($myitem->updated_at)->format('d');
            $h_end = Carbon::parse($myitem->updated_at)->format('h');
            $i_end = Carbon::parse($myitem->updated_at)->format('i');
            $s_end = Carbon::parse($myitem->updated_at)->format('s');
            $item_export->last_modified_data=Carbon::createFromDate($y_end,$m_end,$d_end, 'Africa/Cairo')->startOfDay();
            $item_export->last_modified_time=Carbon::createFromTime($h_end,$i_end,$s_end, 'Africa/Cairo');
            $item_export->net=$myitem->price-$myitem->cost;
            if($myitem->statues == 0)
            {
                $item_export->statues='deactive';
            }
            else
            {
                $item_export->statues='active';
            }
            if($myitem->statues_item_store == 0)
            {
                $item_export->statues_item_store='not found';
            }
            elseif($myitem->statues_item_store == 1)
            {
                $item_export->statues_item_store='wait priceing';
            }
            elseif($myitem->statues_item_store == 2)
            {
                $item_export->statues_item_store='add to store';
            }
            elseif($myitem->statues_item_store == 3)
            {
                $item_export->statues_item_store='inventory';
            }
            elseif($myitem->statues_item_store == 4)
            {
                $item_export->statues_item_store='reserved';
            }
            elseif($myitem->statues_item_store == 5)
            {
                $item_export->statues_item_store='ready for dispatch';
            }
            elseif($myitem->statues_item_store == 6)
            {
                $item_export->statues_item_store='delivered';
            }elseif($myitem->statues_item_store == 7)
            {
                $item_export->statues_item_store='dispatch';
            }elseif($myitem->statues_item_store == 8)
            {
                $item_export->statues_item_store='dispatch w_sales';
            }elseif($myitem->statues_item_store == 9)
            {
                $item_export->statues_item_store='paid';
            }elseif($myitem->statues_item_store == 10)
            {
                $item_export->statues_item_store='scraped';
            }
            $item_export->save();
        }
        return Item_Export::all(['bag','brand','category_type','supplier','type','size','color'
           ,'code','weight','cost','statues','statues_item_store'
            ,'price','discount','net','minimum_price','last_modified_data','last_modified_time']);
    }

}
