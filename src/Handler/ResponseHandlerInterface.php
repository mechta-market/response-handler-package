<?php

namespace Mechta\ResponseHandler\Handler;

use Psr\Http\Message\ResponseInterface;
use Spiral\Filters\FilterInterface;

interface ResponseHandlerInterface
{
    public function handle(ResponseInterface $input, string $class): FilterInterface;
}
