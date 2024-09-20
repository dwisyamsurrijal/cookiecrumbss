<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function index(){
        $products = Product::where('stock', '>', 0)->orderBy('id', 'DESC')->take(6)->get();
        return view('front.index', [
            'products' => $products
        ]);
    }

    public function details(Product $product)
    {
        $otherProducts = Product::where('id', '!=', $product->id)
        ->where('stock', '>', 0)
        ->get();
        return view('front.details', [
            'product' => $product,
            'otherProducts' => $otherProducts
        ]);
    }

    public function allproduct()
    {
        $allproducts = Product::where('stock', '>', 0)->get();
        return view('front.allproduct', [
            'allproducts' => $allproducts
        ]);
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function search(Request $request)
    {
        
        $keyword = $request->input('keyword');

        $products = Product::where('name', 'LIKE', '%' . $keyword . '%')
            ->get();

        return view('front.allproduct', [
            'allproducts' => $products,
            'keyword' => $keyword,
        ]);
    }

    

}
