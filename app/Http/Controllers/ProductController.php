<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Http\Request;
use Auth;

class ProductController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('product', ['user' => $user]);
    }

    public function create(Request $request)
    {
        $length = count($request->name);
        
        for($i = 0; $i <= $length-1; $i++){
            $product = new Favorite();
            $product->name = $request->name[$i];
            $product->url = $request->url[$i];
            $product->jancode = $request->jancode[$i];
            $product->user_id = Auth::id();
            $product->save();
        }

        return view('product');

    }
}
