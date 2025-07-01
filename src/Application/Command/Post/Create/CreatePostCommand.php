<?php

declare(strict_types=1);

namespace App\Application\Command\Post\Create;

use App\Domain\ValueObj\Post\Body;
use App\Domain\ValueObj\Post\Title;

class CreatePostCommand
{
    private Title $title;
    private Body  $body;


    public function __construct(string $title, string $body)
    {
        $this->title = Title::fromStr($title);
        $this->body  = Body::fromStr($body);
    }


    public function title(): Title
    {
        return $this->title;
    }


    public function body(): Body
    {
        return $this->body;
    }
}
