<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::take(3)->get();
        return view('userpages.home', compact('products'));
    }
    public function produts()
    {
        $products = Product::all();
        return view('userpages.products', compact('products'));
    }
}
