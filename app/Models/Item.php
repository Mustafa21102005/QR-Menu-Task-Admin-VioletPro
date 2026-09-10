<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[Fillable(['name', 'description', 'price', 'category_id', 'is_active'])]
class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;

    protected static function booted()
    {
        static::deleting(function (Item $item) {
            if ($item->imageable) {
                Storage::disk('public')->delete($item->imageable->path);
                $item->imageable->delete();
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function imageable()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
