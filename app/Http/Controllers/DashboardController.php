<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $stats = [
            'total_categories' => Category::count(),
            'active_categories' => Category::where('is_active', true)->count(),
            'total_items' => Item::count(),
            'active_items' => Item::where('is_active', true)->count(),
        ];

        $recentItems = Item::with(['category', 'imageable'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'recentItems'));
    }
}
