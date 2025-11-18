<?php

namespace App\Http\Controllers;

use App\BannerStatus;
use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(): \Illuminate\View\View
    {
        $banners = Banner::where('is_active', BannerStatus::Active->value)->get();
        return view('home', compact('banners'));
    }
}
