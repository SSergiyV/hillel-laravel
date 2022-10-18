<?php

namespace App\Repositories\Contract;

use App\Http\Requests\Products\Products\CreateProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Models\Product;

interface ProductRepositoryContract
{
    public function create(CreateProductRequest $request): Product|bool;
    public function update(Product $product, UpdateProductRequest $request): Product|bool;
}
