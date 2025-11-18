<?php

namespace App\Http\Controllers;

use App\BannerStatus;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function home(): \Illuminate\View\View
    {
        $banners = Banner::where('is_active', BannerStatus::Active->value)->get();
        $categories = Category::pluck('name');
        $products = Product::with('category')
            ->where('quantity', '>', 0)
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'category' => $product->category?->name ?? 'Без категории',
                    'price' => number_format($product->price, 0, '.', ''),
                    'old_price' => $product->price + ($product->discount ?? 0),
                    'img' => $product->image
                        ? asset('storage/' . $product->image)
                        : asset('assets/products/no-image.png'),
                    'quantity' => $product->quantity,
                ];
            });


        return view('home', compact('categories', 'products', 'banners'));
    }
}
