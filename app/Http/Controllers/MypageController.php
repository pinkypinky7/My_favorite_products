<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Favorite;

class MypageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $products = $user->favorites()->latest()->paginate(10);
        
       return view('index',  ['user' => $user, 'products' => $products]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $length = count($request->name);
        
        for($i = 0; $i <= $length-1; $i++){
            $product = Favorite::find($request->product_id[$i]);
            $product->name = $request->name[$i];
            $product->url = $request->url[$i];
            $product->jancode = $request->jancode[$i];
            $product->user_id = Auth::id();
            $product->save();
        }
        
        $products = $user->favorites()->latest()->paginate(10);
        return view('index',  ['user' => $user, 'products' => $products]);
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        $product = Favorite::find($request->product_id);
        $product->delete();
        $products = $user->favorites()->latest()->paginate(10);
        return view('index',  ['user' => $user, 'products' => $products]);
}
}
