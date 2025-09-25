<?php

namespace Tests\Unit\Actions;

use Database\Factories\AdminFactory;
use Database\Factories\ProfileFactory;
use Domain\Profile\Actions\ListActiveProfilesAction;
use Domain\Profile\Dto\ListActiveProfilesDto;
use Domain\Profile\Enums\ProfileStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListActiveProfilesActionTest extends TestCase
{
    use RefreshDatabase;

    private ListActiveProfilesAction $action;

    protected function setUp(): void
    {
        parent::setUp();
        $this->action = new ListActiveProfilesAction;
    }

    public function test_list_active_profiles_action(): void
    {
        $admin = AdminFactory::new()->createOne();
        ProfileFactory::new()
            ->setAdminId($admin->id)
            ->createMany(10);
        $dto = new ListActiveProfilesDto(page: 1, per_page: 10);
        $profiles = ($this->action)($dto);

        $this->assertNotEmpty($profiles);
        $this->assertEquals($profiles[0]->status, ProfileStatus::Active);

    }
}
