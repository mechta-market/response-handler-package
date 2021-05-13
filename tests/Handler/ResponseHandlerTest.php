<?php

namespace Handler;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use Mechta\ResponseHandler\Handler\ResponseHandler;
use PHPUnit\Framework\TestCase;
use Spiral\Filters\Exception\FilterException;
use Spiral\Filters\FilterInterface;
use Spiral\Filters\FilterProvider;
use Spiral\Filters\FilterProviderInterface;
use Spiral\Filters\InputInterface;
use Spiral\Http\ResponseWrapper;
use Spiral\Validation\ValidationProvider;
use Spiral\Validation\Validator;

class ResponseHandlerTest extends TestCase
{

    private function getMockClientForString(string $body): Client
    {
        $mock = new MockHandler([
            new Response(200, [], $body)
        ]);
        $handlerStack = HandlerStack::create($mock);
        return new Client(['handler' => $handlerStack]);
    }

    public function testHandle()
    {
        $mockClient = $this->getMockClientForString('{"foo": "bar"}');

        // The first request is intercepted with the first response.
        $response = $mockClient->request('GET', '/');


        /*

        $filterProvider = new FilterProvider(new ValidationProvider(), )

        $reponseHandler = new ResponseHandler();

        */
    }
}
