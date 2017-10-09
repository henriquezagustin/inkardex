<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\Product;
use Validator;
use Illuminate\Support\Facades\Auth;
use Exception;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::where('status_id', '=', 2)->get();
        return view('admin.sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('quantity', '>=', 1)->pluck('id', 'name')->flip()->all();
        return view('admin.sales.create', compact('products'));
    }

    public function open(Request $request)
    {
        $rules = [
            'product_id' => 'required|numeric',
            'quantity' => 'required|numeric'             
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors([$validator->errors()->all()]);
        }

        $product = Product::findOrFail($request->input('product_id'));

        $result = $product->quantity - $request->quantity;

        if ($result <= 0) {
            $error = "Inventario insuficiente para procesar la orden.";
            return redirect()->back()->withErrors([$error]);
        } 

        $user = Auth::user();
        $sale = new Sale;
        $sale->status_id = 1;
        $sale->user_id = $user->id;
        $sale->receipt = 'O' . rand(1, 100000);
        $sale->save();

        $sale->detail()->create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'amount' => $request->quantity * $product->sell_price
        ]);

        $sale->fresh(['detail']);

        if ($sale)
        {
            return redirect()->route('sales.show', ['id' => $sale->id]);
        }
    }

    public function add(Request $request)
    {
        $rules = [
            'product_id' => 'required|numeric',
            'quantity' => 'required|numeric'             
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors([$validator->errors()->all()]);
        }

        $sale = Sale::findOrFail($request->id);
        $product = Product::findOrFail($request->input('product_id'));
        $item = $sale->detail()->where('product_id', $product->id)->first();
        
        // si el producto no existe en la orden lo creamos
        if (! $item) {

            $result = $product->quantity - $request->quantity;

            if ($result <= 0) {
                $error = "Inventario insuficiente para procesar la orden.";
                return redirect()->back()->withErrors([$error]);
            } 

            $sale->detail()->create([
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'amount' => $request->quantity * $product->sell_price
            ]);
        }
        else {
            // si el producto existe actualizamos la cantidad
            $result = $product->quantity - ($request->quantity + $item->quantity);

            if ($result <= 0) {
                $error = "Inventario insuficiente para procesar la orden.";
                return redirect()->back()->withErrors([$error]);
            } 

            $item->quantity += $request->quantity;
            $item->amount = $item->quantity * $product->sell_price;
            $item->update();
        }

        $sale->fresh(['detail']);

        if ($sale)
        {
            return redirect()->route('sales.show', ['id' => $sale->id]);
        }   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->id;
        $sale = Sale::findOrFail($id);
        $sale->status_id = 2;

        foreach ($sale->detail as $detail) {
            $sale->quantity += $detail->quantity;
            $sale->amount += $detail->amount;
        }
        
        $sale->save();
        return redirect()->route('sales.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = Sale::findOrFail($id);
        $products = Product::where('quantity', '>=', 1)->pluck('id', 'name')->flip()->all();
        return view('admin.sales.show', compact('products', 'sale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
        $item_id = $request->input('item_id');

        $sale = Sale::findOrFail($id);

        if ($sale->status_id == 1) {
            $detail = $sale->detail()->where('id', '=', $item_id)->firstOrFail();
            $detail->delete();
        }

        $sale = Sale::findOrFail($id);
        $products = Product::where('quantity', '>=', 1)->pluck('id', 'name')->flip()->all();

        // return redirect()->back()-with();
        return view('admin.sales.create', compact('products', 'sale'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
