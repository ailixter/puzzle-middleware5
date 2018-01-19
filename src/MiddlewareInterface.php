<?php

/*
 * (C) 2018, AII (Alexey Ilyin).
 */

namespace Ailixter\Puzzle;

use Psr\Http\Message\ServerRequestInterface;

/**
 *
 * @author AII (Alexey Ilyin)
 */
interface MiddlewareInterface
{
    /**
     * Process an incoming server request
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $next);
}
