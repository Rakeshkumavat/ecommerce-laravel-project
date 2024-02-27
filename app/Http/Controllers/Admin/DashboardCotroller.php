<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardCotroller extends Controller
{

    public function index()
	{
		return view('admin.dashboard');
	}
    public function adminIndex()
    {
        return view('admin.frontend.index');
    }
    public function blog()
    {
        return view('admin.frontend.blog');
    }
    public function shopGrid()
    {
        return view('admin.frontend.shop_grid');
    }
    public function shopDetails()
    {
        return view('admin.frontend.shop-details');
    }
    public function shopingCart()
    {
        return view('admin.frontend.shoping-cart');
    }
    public function checkout()
    {
        return view('admin.frontend.checkout');
    }
    public function blogDetails()
    {
        return view('admin.frontend.blog-details');
    }
    public function contact()
    {
        return view('admin.frontend.contact');
    }
}
