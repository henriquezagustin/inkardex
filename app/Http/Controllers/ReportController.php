<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ReportController extends Controller
{
    public function index()
    {
        $sales = [];
        $total = DB::table('sales')
                ->select(DB::raw('sum(sales.amount) total'))
                ->where('sales.status_id', 2)
                ->whereMonth('sales.created_at', '=', 7)->value('total');
        array_push($sales, isset($total) ? $total : 0);
        $total = 0;

        $total = DB::table('sales')
                ->select(DB::raw('sum(sales.amount) total'))
                ->where('sales.status_id', 2)
                ->whereMonth('sales.created_at', '=', 8)->value('total');
        array_push($sales, isset($total) ? $total : 0);
        $total = 0;

        $total = DB::table('sales')
                ->select(DB::raw('sum(sales.amount) total'))
                ->where('sales.status_id', 2)
                ->whereMonth('sales.created_at', '=', 9)->value('total');
        array_push($sales, isset($total) ? $total : 0);
        $total = 0;

        $total = DB::table('sales')
                ->select(DB::raw('sum(sales.amount) total'))
                ->where('sales.status_id', 2)
                ->whereMonth('sales.created_at', '=', 10)->value('total');
        array_push($sales, isset($total) ? $total : 0);
        $total = 0;

        array_push($sales, 0);
        array_push($sales, 0);

        $profits = [];
        $total = DB::table('products')
                ->select(DB::raw('sum((products.sell_price - products.price) * sale_details.quantity) total'))
                ->leftJoin('sale_details', 'products.id', '=', 'sale_details.product_id')
                ->leftJoin('sales', 'sale_details.sale_id', '=', 'sales.id')
                ->where('sales.status_id', 2)
                ->whereMonth('sales.created_at', '=', 7)->value('total');
        array_push($profits, isset($total) ? $total : 0);
        $total = 0;

        $total = DB::table('products')
                ->select(DB::raw('sum((products.sell_price - products.price) * sale_details.quantity) total'))
                ->leftJoin('sale_details', 'products.id', '=', 'sale_details.product_id')
                ->leftJoin('sales', 'sale_details.sale_id', '=', 'sales.id')
                ->where('sales.status_id', 2)
                ->whereMonth('sales.created_at', '=', 8)->value('total');
        array_push($profits, isset($total) ? $total : 0);
        $total = 0;

        $total = DB::table('products')
                ->select(DB::raw('sum((products.sell_price - products.price) * sale_details.quantity) total'))
                ->leftJoin('sale_details', 'products.id', '=', 'sale_details.product_id')
                ->leftJoin('sales', 'sale_details.sale_id', '=', 'sales.id')
                ->where('sales.status_id', 2)
                ->whereMonth('sales.created_at', '=', 9)->value('total');
        array_push($profits, isset($total) ? $total : 0);
        $total = 0;

        $total = DB::table('products')
                ->select(DB::raw('sum((products.sell_price - products.price) * sale_details.quantity) total'))
                ->leftJoin('sale_details', 'products.id', '=', 'sale_details.product_id')
                ->leftJoin('sales', 'sale_details.sale_id', '=', 'sales.id')
                ->where('sales.status_id', 2)
                ->whereMonth('sales.created_at', '=', 10)->value('total');
        array_push($profits, isset($total) ? $total : 0);
        $total = 0;

        array_push($profits, 0);
        array_push($profits, 0);

        // -------------------------------------- //
        // venta total 
        $amount = DB::table('sales')
                ->select(DB::raw('sum(sales.amount) amount'))
                ->where('sales.status_id', 2)->value('amount');      
        // numero de ventas
        $quantity = DB::table('sales')
                    ->select(DB::raw('count(sales.receipt) quantity'))
                    ->where('sales.status_id', 2)->value('quantity');
        // venta promedio
        $average = DB::table('sales')
                    ->select(DB::raw('avg(sales.amount) average'))
                    ->where('sales.status_id', 2)->value('average');
        // ganancia total
        $profit = DB::table('products')
                ->select(DB::raw('sum((products.sell_price - products.price) * sale_details.quantity) profit'))
                ->leftJoin('sale_details', 'products.id', '=', 'sale_details.product_id')
                ->leftJoin('sales', 'sale_details.sale_id', '=', 'sales.id')
                ->where('sales.status_id', 2)->value('profit');

        $data = (object) array(
            'amount' => $amount,
            'quantity' => $quantity,
            'average' => $average,
            'profit' => $profit
        );
    	return view('admin.reports.index', compact('data','sales','profits'));
    }

    public function chart()
    {        
        return "";
    }
}
