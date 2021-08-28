<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::orderBy('id', 'asc')->get();

        return Inertia::render('Dashboard', [
            'products' => $product
        ]);
    }
}
