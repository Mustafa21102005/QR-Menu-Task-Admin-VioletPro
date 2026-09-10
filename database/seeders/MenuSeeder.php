<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('seeders/data/menu.json');
        $imagesPath = database_path('seeders/data/images');

        $menu = json_decode(file_get_contents($jsonPath), true);

        foreach ($menu as $categoryName => $items) {
            $category = Category::create([
                'name' => Str::title($categoryName),
                'is_active' => true,
            ]);

            foreach ($items as $itemData) {
                $item = Item::create([
                    'name' => $itemData['name'],
                    'description' => $itemData['description'],
                    'price' => $itemData['price'],
                    'category_id' => $category->id,
                    'is_active' => true,
                ]);

                $filename = basename($itemData['image']);
                $sourcePath = $imagesPath . DIRECTORY_SEPARATOR . $filename;

                if (File::exists($sourcePath)) {
                    $storedPath = 'items/' . $filename;

                    Storage::disk('public')->put(
                        $storedPath,
                        File::get($sourcePath)
                    );

                    $item->imageable()->create([
                        'path' => $storedPath,
                    ]);
                }
            }
        }
    }
}
