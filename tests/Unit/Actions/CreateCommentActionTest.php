<?php

namespace Tests\Unit\Actions;

use Database\Factories\AdminFactory;
use Database\Factories\ProfileFactory;
use Domain\Comment\Actions\CreateCommentAction;
use Domain\Comment\Dto\CreateCommentDto;
use Domain\Comment\Exceptions\CommentAlreadyExistsException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Infrastructure\Models\Comment;
use Tests\TestCase;

class CreateCommentActionTest extends TestCase
{
    use RefreshDatabase;

    private CreateCommentAction $action;

    protected function setUp(): void
    {
        parent::setUp();
        $this->action = new CreateCommentAction;
    }

    public function test_create_comment_action(): void
    {
        $admin = AdminFactory::new()->createOne();
        $profile = ProfileFactory::new()
            ->setAdminId($admin->id)
            ->createOne();
        $content = fake()->text();

        $dto = new CreateCommentDto($content, $profile->id);
        $comment = ($this->action)($dto, $admin->id);

        $this->assertInstanceOf(Comment::class, $comment);
        $this->assertEquals($content, $comment->content);
        $this->assertEquals($profile->id, $comment->profile_id);
        $this->assertDatabaseHas('comment', [
            'content' => $dto->content,
            'profile_id' => $dto->profile_id,
            'admin_id' => $admin->id,
        ]);

    }

    public function test_comment_already_exists(): void
    {
        $admin = AdminFactory::new()->createOne();
        $profile = ProfileFactory::new()
            ->setAdminId($admin->id)
            ->createOne();

        $content1 = fake()->text();

        $dto1 = new CreateCommentDto($content1, $profile->id);
        $comment1 = ($this->action)($dto1, $admin->id);

        $content2 = fake()->text();
        $dto2 = new CreateCommentDto($content2, $profile->id);
        $this->expectException(CommentAlreadyExistsException::class);

        ($this->action)($dto2, $admin->id);

    }
}
