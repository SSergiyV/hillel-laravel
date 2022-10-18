<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileStorageService implements Contracts\FileStorageServiceContract
{
    /**
     * @inheritDoc
     */
    public static function upload(string|UploadedFile $file): string
    {
        if (is_string($file)) {
            return str_replace('public/storage', '', $file);
        }
        $filePath = 'public/images/' . static::randomName() . '.' . $file->getClientOriginalExtension();

        Storage::put($filePath, File::get($file));

        return $filePath;
    }

    public static function remove(string $file)
    {
        Storage::delete($file);
    }

    protected static function randomName() {

        return Str::random() . '_' . time();
    }
}
