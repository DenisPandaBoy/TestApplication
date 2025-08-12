<?php

namespace App\Services;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Str;

class CategoryService
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository
    ){}

    public function createCategory(array $data): Category
    {
        $slug = Str::slug($data['name'], '-');

        $appending_number = $this->categoryRepository->getSlugAppendingNumber($slug);

        if($appending_number > 0) $slug .= '-' . $appending_number;

        $data['slug'] = $slug;

        return Category::create($data);
    }

    public function updateCategory(Category $category, array $data): Category
    {
        $category->update($data);
        return $category;
    }

    public function destroy(Category $category): Category
    {
        $category->delete();
        return $category;
    }
}
