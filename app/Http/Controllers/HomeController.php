<?php

namespace App\Http\Controllers;

use App\BannerStatus;
use App\Models\Banner;
use App\Models\Category;

class HomeController extends Controller
{
    public function home(): \Illuminate\View\View
    {
        $banners = Banner::where('is_active', BannerStatus::Active->value)->get();

        $categoriesWithProducts = Category::where('name', '!=', 'книги')
            // Добавляем случайную сортировку на уровне базы данных
            ->inRandomOrder()
            ->with(['products' => function ($query) {
                $query->latest()->take(4);
            }])
            ->get()
            ->map(function ($category) {
                return [
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'products' => $category->products->map(fn ($p) => [
                        'id' => $p->id,
                        'name' => $p->name,
                        'slug' => $p->slug,
                        'price' => $p->price,
                        'old_price' => $p->price + ($p->discount ?? 0),
                        'img' => $p->image ? asset('storage/'.$p->image) : asset('assets/products/no-image.png'),
                        'quantity' => $p->quantity,
                    ]),
                ];
            });

        return view('home', compact('categoriesWithProducts', 'banners'));
    }
}
