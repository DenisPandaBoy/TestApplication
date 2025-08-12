<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryService
{
    public function createCategory(array $data): Category
    {
        $data['slug'] = Str::slug($data['name'], '-');

        return Category::create($data);
    }

    public function updateCategory(Category $category, array $data): Category
    {
        if (array_key_exists('name', $data)) $data['slug'] = Str::slug($data['name'], '-');

        $category->update($data);
        return $category;
    }

    public function destroy(Category $category): Category
    {
        $category->delete();
        return $category;
    }
}
