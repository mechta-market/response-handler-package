<?php


namespace Mechta\ResponseHandler\Handler;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Spiral\Filters\ArrayInput;
use Spiral\Filters\FilterInterface;
use Spiral\Filters\FilterProviderInterface;


class ResponseHandler implements ResponseHandlerInterface
{

    private FilterProviderInterface $filterProvider;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    public function __construct(FilterProviderInterface $filterProvider, LoggerInterface $logger)
    {
        $this->filterProvider = $filterProvider;
        $this->logger = $logger;
    }

    public function handleFromArray(array $input, string $class): FilterInterface
    {
        return $this->filterProvider->createFilter(
            $class,
            new ArrayInput($input)
        );
    }

    public function handle(ResponseInterface $input, string $class): FilterInterface
    {
        try {
            $value = $input->getBody()->getContents();

            $escapes =      array("\\",  "\n",  "\r",  "\t",  "\x08", "\x0c");
            $replacements = array("/",   " ",   " ",   "  ",   "",     "");
            $result = str_replace($escapes, $replacements, $value);

            $inputBody = json_decode($result, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            $this->logger->critical('Remote server response parsing error', ['message' => $e->getMessage()]);
            throw new \RuntimeException($e->getMessage());
        }

        return $this->handleFromArray($inputBody, $class);
    }
}
