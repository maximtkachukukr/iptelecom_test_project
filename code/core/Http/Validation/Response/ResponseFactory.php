<?php

declare(strict_types=1);

namespace Core\Http\Validation\Response;

class ResponseFactory
{
    /**
     * Create new Response instance
     *
     * @param bool $isValid
     * @param array $messages
     * @return ResponseInterface
     */
    public function create(bool $isValid, array $messages): ResponseInterface
    {
        return new Response($isValid, $messages);
    }
}