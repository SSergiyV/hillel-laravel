<?php

namespace App\Repositories\Contract;

use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Products\CreateProductRequest;
use App\Models\Product;

interface ProductRepositoryContract
{
    public function create(CreateProductRequest $request): Product|bool;
}
