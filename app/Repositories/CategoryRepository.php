<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

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
}
