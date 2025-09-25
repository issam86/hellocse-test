<?php

namespace Tests\Unit\Actions;

use Domain\Profile\Actions\UploadImageAction;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadImageActionTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->action = new UploadImageAction;
    }

    public function test_upload_image_action(): void
    {
        Storage::fake('public');
        $image = UploadedFile::fake()->image('profile.jpg',300, 300);

        $uploadedImage = ($this->action)($image);

        Storage::disk('public')->assertExists($uploadedImage);
    }

}
