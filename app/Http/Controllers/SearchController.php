<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        $products = collect();

        if ($query) {
            $products = Product::where('name', 'LIKE', "%{$query}%")
                ->latest()
                ->paginate(12);
        }

        return view('products.index', [
            'products' => $products,
            'searchQuery' => $query,
        ]);
    }
}
