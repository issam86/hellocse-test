<?php

namespace Tests\Unit\Actions;

use Database\Factories\AdminFactory;
use Database\Factories\ProfileFactory;
use Domain\Profile\Actions\DeleteProfileAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteProfileActionTest extends TestCase
{
    use RefreshDatabase;

    private DeleteProfileAction $action;

    protected function setUp(): void
    {
        parent::setUp();
        $this->action = new DeleteProfileAction;
    }

    public function test_delete_profile(): void
    {
        $admin = AdminFactory::new()->createOne();
        $profile = ProfileFactory::new()
            ->setAdminId($admin->id)
            ->createOne();
        $result = ($this->action)($profile);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('profile', ['id' => $profile->id]);
    }
}
