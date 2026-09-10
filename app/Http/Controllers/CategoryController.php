<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\{StoreCategoryRequest, UpdateCategoryRequest};

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create([
            'name' => $request->validated('name'),
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->validated('name'),
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->items()->exists()) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'You cannot delete this category because it still has items assigned to it.');
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
