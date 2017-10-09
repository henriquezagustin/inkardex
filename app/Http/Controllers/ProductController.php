<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Photo;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('id', 'name')->flip()->all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'category_id' => 'required|numeric',
            'name' => 'required|alpha_num_spaces|unique:products',
            'quantity' => 'required|numeric',
            'price' => 'required|regex:/^\d*(\.\d{2})?$/',
            'sell_price' => 'required|regex:/^\d*(\.\d{2})?$/'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors([$validator->errors()->all()]);
        }

        $product = Product::create([
            'category_id' => $request->category_id,
            'sku' => 'SKU' . rand(1, 100000),
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'sell_price' => $request->sell_price
        ]);

        if ($file = $request->file('photo_id')) {
            $name = 'IMG_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads', $name);
            $product->photos()->create([
                'name' => $name,
                'path' => '/uploads/' . $name
            ]);
        }

        return redirect('/admin/products')->with('status', 'The product ' . $product->name . ' was succesfully stored.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::pluck('id', 'name')->flip()->all();
        return view('admin.products.edit', compact('product', 'categories'));
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
        $product = Product::findOrFail($id);

        $rules = [
            'category_id' => 'required|numeric',
            'name' => 'required|alpha_num_spaces|unique:products,name,' . $product->id . ',id',
            'quantity' => 'required|numeric',
            'price' => 'required|regex:/^\d*(\.\d{2})?$/',
            'sell_price' => 'required|regex:/^\d*(\.\d{2})?$/'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors([$validator->errors()->all()]);
        }

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'sell_price' => $request->sell_price
        ]);

        if ($file = $request->file('photo_id')) {
            $name = 'IMG_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads', $name);

            if ($product->photos) {
                $product->photos()->delete();
            }

            // $photo = $product->defaultImage();           

            // if ($photo) {
            //     if (file_exists(public_path() . $photo->path)) {                    
            //         if (unlink(public_path() . $photo->path))
            //             $photo->delete();    
            //     }
            // }

            $product->photos()->create([
                'name' => $name,
                'path' => '/uploads/' . $name
            ]);
        }

        return redirect('/admin/products')->with('status', 'The product ' . $product->name . ' was succesfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        // $photo = $product->photos()->first();

        if ($product->photos) {
            $product->photos()->delete();
        }           

        // if ($photo) {
        //     if (file_exists(public_path() . $photo->path)) {                    
        //         if (unlink(public_path() . $photo->path))
        //             $photo->delete();    
        //     }
        // }

        $product->delete();
        return redirect('/admin/products')->with('status', 'The product ' . $product->name . ' was succesfully deleted.');
    }
}
