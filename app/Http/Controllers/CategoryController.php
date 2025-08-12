<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Interfaces\CategoryRepositoryInterface;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends APIController
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly CategoryService             $categoryService
    )
    {
    }

    public function index(): JsonResponse
    {
        $categories = $this->categoryRepository->getCategories();

        $resource = CategoryResource::collection($categories);
        return $this->responseJson(data: $resource);
    }

    public function show(int $id): JsonResponse
    {
        $category = $this->categoryRepository->getCategoryById($id);

        $resource = new CategoryResource($category);
        return $this->responseJson(data: $resource);
    }

    public function store(CreateCategoryRequest $request): JsonResponse
    {
        $category = $this->categoryService->createCategory($request->all());

        $resource = CategoryResource::make($category);
        return $this->responseJson(data: $resource);
    }

    public function update(UpdateCategoryRequest $request, int $id): JsonResponse
    {
        $category = $this->categoryRepository->getCategoryById($id);

        $this->categoryService->updateCategory($category, $request->all());

        $resource = CategoryResource::make($category);
        return $this->responseJson(data: $resource, message: "category $category->id updated");
    }

    public function destroy(int $id): JsonResponse
    {
        $category = $this->categoryRepository->getCategoryById($id);

        $category->delete();

        return $this->responseJson(message: "category $category->name has been deleted");
    }
}
