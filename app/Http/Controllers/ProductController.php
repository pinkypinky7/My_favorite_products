<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('product');
    }

    public function create(Request $request)
    {
        $product = new Favorite();
        $product->name = $request->name;
        $product->url = $request->url;
        $product->JANcode = $request->JANcode;
        $product->save();
        return view('/');
    }
}
