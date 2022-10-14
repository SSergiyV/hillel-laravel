<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class FileStorageService implements Contracts\FileStorageServiceContract
{
    /**
     * @inheritDoc
     */
    public static function upload(string|UploadedFile $file): string
    {
        // TODO: Implement upload() method.
    }

    public static function remove(string $string)
    {
        // TODO: Implement remove() method.
    }
}
