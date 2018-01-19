<?php

/*
 * (C) 2018, AII (Alexey Ilyin).
 */

namespace Ailixter\Puzzle\Example;

use Ailixter\Puzzle\MiddlewareInterface;
use Ailixter\Puzzle\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @author AII (Alexey Ilyin)
 */
class Middleware implements MiddlewareInterface
{
    private $attr;
    private $value;

    /**
     * @var ResponseFactory
     */
    private $responseFactory;
    /**
     * @var StreamFactory
     */
    private $streamFactory;

    public function __construct($attr, $value)
    {
        $this->attr  = $attr;
        $this->value = $value;
    }

    public function setFactories(ResponseFactory $responseFactory, StreamFactory $streamFactory)
    {
        $this->responseFactory = $responseFactory;
        $this->streamFactory = $streamFactory;
        return $this;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $next)
    {
        $request = $this->makeRequest($request);
        if ($this->responseFactory && $this->streamFactory) {
            return $this->responseFactory->createResponse()->withBody(
                $this->streamFactory->createStream($this->makeContent($request))
            );
        }
        return $next->handle($request);
    }

    protected function makeRequest(ServerRequestInterface $request)
    {
        return $request->withAttribute($this->attr, $this->value);
    }

    protected function makeContent(ServerRequestInterface $request)
    {
        return json_encode($request->getAttributes());
    }
}
