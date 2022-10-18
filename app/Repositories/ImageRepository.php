<?php

namespace App\Repositories;

use App\Repositories\Contract\ImageRepositoryContract;
use Illuminate\Database\Eloquent\Model;

class ImageRepository implements ImageRepositoryContract
{
    public static function attach(Model $model, string $methodName, array $images = [])
    {
        if (!method_exists($model, $methodName)) {
            throw new \Exception($model::class . " doesn't have {$methodName}");
        }

        if (!empty($images)) {
            foreach ($images as $image) {
                call_user_func([$model, $methodName])->create(['path' => $image]);
            }
        }
    }
}
