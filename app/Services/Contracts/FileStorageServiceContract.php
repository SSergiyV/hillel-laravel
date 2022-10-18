<?php

namespace App\Services\Contracts;

use Illuminate\Http\UploadedFile;

interface FileStorageServiceContract
{
    /**
     * @param UploadedFile|string $file
     * @return string
     */
    public static function upload(UploadedFile|string $file): string;

    public static function remove(string $file);
}
