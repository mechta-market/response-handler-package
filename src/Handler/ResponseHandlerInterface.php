<?php

namespace Mechta\ResponseHandler\Handler;

use Psr\Http\Message\ResponseInterface;
use Spiral\Filters\Filter;

interface ResponseHandlerInterface
{
    public function handle(ResponseInterface $input, string $class): Filter;
}
