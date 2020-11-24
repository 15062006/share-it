<?php

namespace App\Controller;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Slim\Interfaces\RouteParserInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Base class for controllers
 */
abstract class AbstractController
{
    /** @var Environment */
    private $twig;
    /** @var RouteParserInterface */
    private $routeParser;
    /** @var ResponseFactoryInterface */
    private $responseFactory;
    /** @var StreamFactoryInterface */
    private $streamFactory;

    /**
     * AbstractController constructor.
     */
    public function __construct(
        Environment $twig,
        RouteParserInterface $routeParser,
        ResponseFactoryInterface $responseFactory,
        StreamFactoryInterface $streamFactory
    ) {
        $this->twig = $twig;
        $this->routeParser = $routeParser;
        $this->responseFactory = $responseFactory;
        $this->streamFactory = $streamFactory;
    }

    /**
     * Returns a Response with a Twig template body
     *
     * @param ResponseInterface $response   Response to use
     * @param string            $template   path to the Twig template starting from the /templates/ directory
     * @param array             $vars       associative array containing the template variables
     *
     * @return ResponseInterface    A modified response with new body
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    protected function template(ResponseInterface $response, string $template, array $vars = []) : ResponseInterface
    {
        $content = $this->twig->render($template, $vars);
        $stream = $this->streamFactory->createStream($content);

        return $response->withBody($stream);
    }

    /**
     * Redirects to another route
     *
     * @param string $routeName
     * @param array  $params
     * @param int    $statusCode
     *
     * @return ResponseInterface new Response with redirection header
     *
     * @throws \UnexpectedValueException when the status code is not a valid redirection code
     */
    protected function redirect(string $routeName, array $params = [], int $statusCode = 302): ResponseInterface
    {
        if ($statusCode < 300 || $statusCode >= 400) {
            throw new \UnexpectedValueException(
                sprintf('The %d code is not a valid HTTP redirection status code.', $statusCode)
            );
        }

        $response = $this->responseFactory->createResponse($statusCode);
        $url = $this->routeParser->urlFor($routeName, $params);

        return $response->withHeader('Location', $url);
    }
}