<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Sale;
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

    public function sales()
    {
        $sales = Sale::orderBy('id', 'asc')->get();

        return Inertia::render('History', [
            'sales' => $sales
        ]);
    }
}
