<?php

namespace App\Http\Controllers\admin;

use App\Exports\ArticaleExport;
use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_Item;
use App\Exports\ItemExport;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;


class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function indexorderdiscarded()
    {
        $order = Order::where('statues', 11)->get();
        return view('admin.report.index_order_discarded', compact('order'));
    }

    public function selecttimeexport()
    {
        return view('admin.report.export_data');
    }

    public function showorderdiscarded($id)
    {
        /*    $order = Order_Item::with('order', 'item.brand', 'item.type', 'item.size', 'item.color', 'item.gender')*/
        $order = Order_Item::with('order', 'item.brand', 'item.type', 'item.size', 'item.color')
            ->where('order_id', '=', $id)->get();
        return view('admin.report.show_order_discarded', compact('order'));
    }

    public function selecttimesales()
    {
        return view('admin.report.sales');
    }

    public function export(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');
        $y_start = Carbon::parse($start)->format('20y');
        $m_start = Carbon::parse($start)->format('m');
        $d_start = Carbon::parse($start)->format('d');
        $y_end = Carbon::parse($end)->format('20y');
        $m_end = Carbon::parse($end)->format('m');
        $d_end = Carbon::parse($end)->format('d');
        $dat_s = Carbon::createFromDate($y_start, $m_start, $d_start, 'Africa/Cairo')->startOfDay();
        $dat_e = Carbon::createFromDate($y_end, $m_end, $d_end, 'Africa/Cairo')->startOfDay();
        return Excel::download(new ItemExport($dat_s, $dat_e), time() . ' ' . 'Items.xlsx');

    }

    public function indexsales(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');
        $y_start = Carbon::parse($start)->format('y');
        $m_start = Carbon::parse($start)->format('m');
        $d_start = Carbon::parse($start)->format('d');
        $y_end = Carbon::parse($end)->format('y');
        $m_end = Carbon::parse($end)->format('m');
        $d_end = Carbon::parse($end)->format('d');
        $dat_e = Carbon::createFromDate('20' . $y_end, $m_end, $d_end, 'Africa/Cairo')->startOfDay();
        for ($i = 0; $i < 12; $i++) {
            if ($i == 0) {
                $dat_s[$i] = Carbon::createFromDate('20' . $y_start, $m_start, $d_start, 'Africa/Cairo')->startOfDay();
                $name_x[$i] = Carbon::parse($dat_s[$i])->format('m');
            } else {
                $dat_s[$i] = Carbon::createFromDate('20' . $y_start, $m_start + $i, '1', 'Africa/Cairo')->startOfDay();
                $name_x[$i] = Carbon::parse($dat_s[$i])->format('m');
            }
            if ($dat_s[$i] > $dat_e) {
                $dat_s[$i] = Carbon::createFromDate('20' . $y_end, $m_end, $d_end, 'Africa/Cairo')->startOfDay();
                $name_x[$i] = Carbon::parse($dat_s[$i])->format('m');
                break;
            }
        }

        $sales = 0;
        $cost = 0;
        for ($i = 0; $i < count($dat_s) - 1; $i++) {
            $sales_1[$i] = 0;
            $cost_1[$i] = 0;
            $net_1[$i] = 0;
            $sale = Order::where('time_pay', '>=', $dat_s[$i])
                ->where('time_pay', '<=', $dat_s[$i + 1])
                ->where('statues', 10)->get();
            foreach ($sale as $ordersales) {
                $sales_1[$i] = $sales + $ordersales->total_cost;
                $order_item = Order_Item::where('order_id', $ordersales->id)->get();
                foreach ($order_item as $orderitem) {
                    $item = Item::find($orderitem->item_id);
                    if ($item != null) {
                        $cost_1[$i] = $cost + $item->cost;
                    } else {
                        $cost_1[$i] = $cost + 0;
                    }
                }
            }
            $net_1[$i] = $sales_1[$i] - $cost_1[$i];
        }


        return view('admin.report.sales_index',
            compact('name_x', 'sales_1', 'cost_1', 'net_1', 'dat_s'));
    }

    public function report_sales_all()
    {
        $sales = 0;
        $cost = 0;
        $sale = Order::where('statues', 10)->get();
        foreach ($sale as $ordersales) {
            $sales = $sales + $ordersales->total_cost;
            $order_item = Order_Item::where('order_id', $ordersales->id)->get();
            foreach ($order_item as $orderitem) {
                $item = Item::find($orderitem->item_id);
                if ($item != null) {
                    $cost = $cost + $item->cost;
                } else {
                    $cost = $cost + 0;
                }
            }
        }
        $net = $sales - $cost;

        return view('admin.report.sales_index_all',
            compact( 'sales', 'cost', 'net'));
    }
    public function report_store_all()
    {
        $price = 0;
        $cost = 0;
        $scraped_cost = 0;
        $item = Item::where('statues_item_store', '!=',9)->where('statues_item_store', '!=',6)->where('statues_item_store', '!=',10)->get();
        foreach ($item as $orderprice) {
            $price = $price + $orderprice->price;
            $cost = $cost + $orderprice->cost;

        }
        $scraped = Item::where('statues_item_store',10)->get();
        foreach ($scraped as $orderprice) {
            $scraped_cost = $scraped_cost + $orderprice->cost;

        }
        $net = $price - $cost;

        return view('admin.report.store',
            compact( 'price', 'cost', 'net','scraped_cost'));
    }
}

?>