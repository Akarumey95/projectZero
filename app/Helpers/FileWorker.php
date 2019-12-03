<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class FileWorker
{
    /**
     * @param $path_toStore
     * @param $file
     * @return string
     */
    public static function save($path_toStore, $file)
    {
        $path = $file->store($path_toStore, 'public');
        return getenv('APP_URL') . '/storage/' . $path;
    }

    /**
     * @param $path_toDelete
     */
    public static function delete($path_toDelete)
    {
        $path = str_replace(getenv('APP_URL') . '/storage/', '', $path_toDelete);
        Storage::disk('public')->delete($path);
    }
}
