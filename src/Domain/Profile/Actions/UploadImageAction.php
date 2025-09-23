<?php

namespace Domain\Profile\Actions;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadImageAction
{
    public function __invoke(UploadedFile $image):string
    {
        $imageName = uniqid();
        $path = Storage::disk('public')->put('profiles/'.$imageName, $image);

        return $path;

    }

}
