<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();

        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();

        return view('items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        $item = Item::create([
            'name' => $request->validated('name'),
            'description' => $request->validated('description'),
            'price' => $request->validated('price'),
            'category_id' => $request->validated('category_id'),
            'is_active' => $request->boolean('is_active'),
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('items', 'public');

            $item->imageable()->create([
                'path' => $path,
            ]);
        }

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $categories = Category::get();

        return view('items.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->update([
            'name' => $request->validated('name'),
            'description' => $request->validated('description'),
            'price' => $request->validated('price'),
            'category_id' => $request->validated('category_id'),
            'is_active' => $request->boolean('is_active'),
        ]);

        if ($request->hasFile('image')) {
            if ($item->imageable) {
                Storage::disk('public')->delete($item->imageable->path);
                $item->imageable->delete();
            }

            $path = $request->file('image')->store('items', 'public');

            $item->imageable()->create([
                'path' => $path,
            ]);
        }

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
