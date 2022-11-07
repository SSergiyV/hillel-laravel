<?php

namespace App\Repositories;

use App\Http\Requests\Products\Categories\CreateCategoryRequest;
use App\Http\Requests\Products\Products\CreateProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryContract;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryContract
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
            ImageRepository::attach($product, 'images', $images);

            DB::commit();

            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            logs()->warning($e);
            return false;
        }
    }

    public function update(Product $product, UpdateProductRequest $request): bool
    {
        try {
            DB::beginTransaction();

            $product->update($request->validated());
            ImageRepository::attach($product, 'images', $request->images ?? []);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            logs()->warning($e);
            return false;
        }
    }
}
