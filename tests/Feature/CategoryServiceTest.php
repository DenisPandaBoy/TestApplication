<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Services\CategoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_createCategory_function(): void
    {
        $inputData = Category::factory()->make()->toArray();

        $categoryRepository = new CategoryRepository();
        $categoryService = new CategoryService($categoryRepository);
        $categoryService->createCategory($inputData);

        $this->assertDatabaseHas('categories', $inputData);
    }

    public function test_updateCategory_function(): void{
        $category = Category::factory()->create();
        $inputData = Category::factory()->make()->toArray();

        $categoryRepository = new CategoryRepository();
        $categoryService = new CategoryService($categoryRepository);
        $categoryService->updateCategory($category,$inputData);

        $this->assertDatabaseHas('categories', array_merge($inputData,['id'=>$category->id]));
    }

    public function test_deleteCategory_function(): void{
        $category = Category::factory()->create();
        $categoryRepository = new CategoryRepository();
        $categoryService = new CategoryService($categoryRepository);
        $categoryService->destroy($category);

        $this->assertDatabaseMissing('categories', $category->toArray());
    }
}
