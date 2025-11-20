<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request, string $category = null)
    {
        $query = Product::latest();

        $currentCategory = null;

        if ($category) {
            $currentCategory = Category::where('slug', $category)->firstOrFail();
            $query->where('category_id', $currentCategory->id);
        }

        $products = $query->paginate(12);

        return view('products.index', compact('products', 'currentCategory'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
