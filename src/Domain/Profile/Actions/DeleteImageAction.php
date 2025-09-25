<?php

namespace Domain\Profile\Actions;

use Illuminate\Support\Facades\Storage;

class DeleteImageAction
{
    public function __invoke(string $imagePath): bool
    {
        if (file_exists($imagePath)) {
            return Storage::disk('public')->delete($imagePath);
        }
        return true;
    }
}
