<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = auth()->user()
            ->wishlists()
            ->with('product')
            ->get();

        $wishlistProductIds = $wishlists->pluck('product.id')->toArray();

        return view('wishlist.index', compact('wishlists', 'wishlistProductIds'));
    }


    public function store(Request $request)
    {
        auth()->user()->wishlists()
            ->firstOrCreate([
                'product_id' => $request->product_id,
            ]);

        return response()->noContent();
    }

    public function destroy(Product $product)
    {
        auth()->user()->wishlists()
            ->where('product_id', $product->id)
            ->delete();

        return response()->noContent();
    }
}
