<?php

/*
 * (C) 2018, AII (Alexey Ilyin).
 */

namespace Ailixter\Puzzle;

use Psr\Http\Message\ServerRequestInterface;

/**
 * @author AII (Alexey Ilyin)
 */
interface RequestHandlerInterface
{
    /**
     * Handles a request and produces a response
     *
     * May call other collaborating code to generate the response.
     * @param ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(ServerRequestInterface $request);
}
