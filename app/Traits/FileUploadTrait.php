<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait FileUploadTrait
{

    function uploadFile(
        Request $request,
        string $inputName,
        ?string $oldPath = null,
        string $path = '/uploads'
    ): string {
        if ($request->hasFile($inputName)) {
            $file = $request->{$inputName};
            $ext = $file->getClientOriginalExtension($file);
            $fileName = 'media_' . uniqid() . '.' . $ext;
            $file->move(public_path($path), $fileName);

            if ($oldPath !== null) {
                $oldFilePath = public_path($oldPath);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            return $path . '/' . $fileName;
        }
        return '';
    }
}
