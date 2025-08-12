<?php

namespace App\Interfaces;

use App\Models\Category;
use App\Models\Order;
use \Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    public function getCategories(): Collection;

    public function getCategoryById(int $categoryId): Category;

    public function getSlugAppendingNumber(string $slug): int;
}
