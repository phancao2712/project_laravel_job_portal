<?php

namespace App\Traits;

trait DeleteFile
{
    function deleteFile($oldPath)
    {
        if ($oldPath !== null) {
            $oldFilePath = public_path($oldPath);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }
    }
}
