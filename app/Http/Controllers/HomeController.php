<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('is_active', true)
            ->with(['items' => function ($query) {
                $query->where('is_active', true)->with('imageable');
            }])
            ->get();

        return view('home', compact('categories'));
    }
}
