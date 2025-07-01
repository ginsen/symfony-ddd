<?php

namespace App\Tests\Unit\Application\Command\Post\Create;

use App\Application\Command\Post\Create\CreatePostCommand;
use App\Domain\ValueObj\Post\Body;
use App\Domain\ValueObj\Post\Title;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(CreatePostCommand::class)]
#[UsesClass(Title::class)]
#[UsesClass(Body::class)]
class CreatePostCommandTest extends TestCase
{
    #[Test]
    public function it_should_be_able_to_create_a_post()
    {
        $command = new CreatePostCommand('test', 'my test content');

        self::assertInstanceOf(Title::class, $command->title());
        self::assertInstanceOf(Body::class, $command->body());
    }
}
