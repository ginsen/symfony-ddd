<?php

declare(strict_types=1);

namespace App\UI\ApiRest;

use App\Application\Command\Post\Create\CreatePostCommand;
use App\Domain\Exception\InvalidArgumentException;
use App\Domain\K;
use App\Infrastructure\Symfony\Controller\BaseController;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CreatePostController extends BaseController
{
    #[Route('post', name: 'post.create', methods: ['POST'])]
    #[OA\Post(
        description: 'Create a post with title and content body.',
        summary: 'Create a post',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: [K::TITLE, K::CONTENT],
                properties: [
                    new OA\Property(property: K::TITLE, description: 'Post title', type: 'string'),
                    new OA\Property(property: K::CONTENT, description: 'Post content', type: 'string'),
                ]
            )
        ),
        tags: ['Posts'],
        responses: [
            new OA\Response(
                response: 201,
                description: 'Created a post',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: K::SUCCESS, type: 'boolean', example: true),
                    ]
                )
            ),
            new OA\Response(
                response: 200,
                description: 'No created post',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: K::SUCCESS, type: 'boolean', example: false),
                    ]
                )
            ),
            new OA\Response(
                response: 400,
                description: 'Bad arguments',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: K::ERROR, type: 'string', example: 'Invalid argument'),
                    ]
                )
            ),
            new OA\Response(
                response: 500,
                description: 'Internal server error',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: K::ERROR, type: 'string', example: 'Exception message'),
                    ]
                )
            ),
        ]
    )]
    public function __invoke(Request $request): Response
    {
        try {
            $command = $this->getCommand($request);
            $result  = $this->commandHandler($command);

            return $this->json(['success' => $result], $result ? 201 : 200);
        } catch (\Exception $e) {
            return $this->responseException($e);
        }
    }


    private function getCommand(Request $request): CreatePostCommand
    {
        try {
            $data = json_decode($request->getContent(), true);

            return new CreatePostCommand(
                $data[K::TITLE],
                $data[K::CONTENT]
            );
        } catch (\Exception $e) {
            throw new InvalidArgumentException($e->getMessage(), 400, $e);
        }
    }
}
