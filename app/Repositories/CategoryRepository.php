<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getCategories(): Collection
    {
        return Category::all();
    }

    public function getCategoryById(int $categoryId): Category
    {
        return Category::findOrFail($categoryId);
    }

    public function getCategoriesWithIdenticalSlug(string $slug): Collection
    {
        return Category::whereLike('slug',$slug .'%')->get();
    }
}
