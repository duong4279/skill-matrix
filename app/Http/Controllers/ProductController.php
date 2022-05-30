<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id','desc')->paginate(5);
        return view('products.index', $products);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => 'required',
            "detail" => 'required',
            "quantity" => 'required',
        ]);
        Product::create($request->all());
        return redirect('route.index')->with('success', 'Product created succesfully.');
    }
}
