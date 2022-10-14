<?php

namespace App\Repositories;

use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Products\CreateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository implements Contract\ProductRepositoryContract
{
    public function __construct(protected Product $product) {}

    public function create(CreateProductRequest $request): Product|bool
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();
            $images = $data['images'] ?? [];
            $category = Category::find($data['category']);
            $product = $category->products()->create($data);

            DB::commit();

            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            logs()->warning($e);
            return false;
        }
    }
}
