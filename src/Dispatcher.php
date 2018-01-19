<?php

/*
 * (C) 2018, AII (Alexey Ilyin).
 */

namespace Ailixter\Puzzle;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @author AII (Alexey Ilyin)
 */
class Dispatcher implements RequestHandlerInterface, MiddlewareInterface
{
    /**
     * @var MiddlewareInterface[]
     */
    private $list = [];
    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ResponseInterface $fallback)
    {
        $this->response = $fallback;
    }

    public function add(MiddlewareInterface $middleware)
    {
        $this->list[] = $middleware;
        return $this;
    }

    /**
     * @param \Ailixter\Puzzle\ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request)
    {
        $middleware = $this->list ? array_shift($this->list) : $this;
        return $middleware->process($request, $this);
    }

    /**
     * @param ServerRequestInterface $request
     * @param \Ailixter\Puzzle\RequestHandlerInterface $next
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $next)
    {
        return $this->response;
    }
}
