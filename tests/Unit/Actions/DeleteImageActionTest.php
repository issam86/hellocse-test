<?php

namespace Tests\Unit\Actions;

use Domain\Profile\Actions\DeleteImageAction;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DeleteImageActionTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->action = new DeleteImageAction;
    }

    public function test_delete_image_action(): void
    {
        Storage::fake('public');
        $image = UploadedFile::fake()->image('profile.jpg',300, 300);

        $deletedImage = ($this->action)($image);

        $this->assertFalse(Storage::disk('public')->exists($deletedImage));
    }

}
