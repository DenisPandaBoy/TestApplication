<?php

namespace App\Services;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CategoryService
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository
    )
    {
    }

    public function createCategory(array $data): Category
    {
        $data['slug'] = $this->generateSlug($data['name']);
        $category = Category::create($data);
        Cache::forget('categories');
        return $category;
    }

    public function updateCategory(Category $category, array $data): Category
    {
        $category->update($data);
        Cache::forget('categories');
        return $category;
    }

    public function destroy(Category $category): Category
    {
        $category->delete();
        Cache::forget('categories');
        return $category;
    }

    private function generateSlug($name): string
    {
        $slug = Str::slug($name, '-');
        $categories = $this->categoryRepository->getCategoriesWithIdenticalSlug($slug);
        $count = 0;
        while (true)
        {
            $append = $count == 0 ? "" : "-$count";

            if ($categories->doesntContain('slug',value: $slug . $append)) return $slug . $append;

            $count++;
        }
    }
}
