<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getCategories(): Collection
    {
        return Cache::rememberForever('categories', function () {
            return Category::all();
        });
    }

    public function getCategoryById(int $categoryId): Category
    {
        if(!Cache::has('categories')) $this->getCategories();
        return Cache::get('categories')->where('id',$categoryId)->First();
    }

    public function getCategoriesWithIdenticalSlug(string $slug): Collection
    {
        if(!Cache::has('categories')) $this->getCategories();
        return Cache::get('categories')->filter(function ($category) use ($slug) {
            return Str::startsWith($category->slug, $slug);
        });
    }
}
