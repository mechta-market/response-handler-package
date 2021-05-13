<?php
namespace Mechta\ResponseHandler\Bootloader;

use Mechta\ResponseHandler\Handler\ResponseHandler;
use Mechta\ResponseHandler\Handler\ResponseHandlerInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Bootloader\Security\FiltersBootloader;

class ResponseHandlerBootloader extends Bootloader
{
    public const DEPENDENCIES = [
        FiltersBootloader::class
    ];

    public const BINDINGS = [
        ResponseHandlerInterface::class => ResponseHandler::class
    ];
}
