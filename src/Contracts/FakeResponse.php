<?php

declare(strict_types=1);

namespace Saloon\Contracts;

use Closure;
use Throwable;
use Saloon\Http\Faking\Fixture;
use Psr\Http\Message\ResponseInterface;
use Saloon\Contracts\Body\BodyRepository;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;

/**
 * @method static static make(mixed $body = [], int $status = 200, array $headers = []) Create a new mock response
 */
interface FakeResponse
{
    /**
     * Get the status from the responses
     */
    public function status(): int;

    /**
     * Get the headers
     *
     * @return \Saloon\Contracts\ArrayStore
     */
    public function headers(): ArrayStore;

    /**
     * Get the response body
     */
    public function body(): BodyRepository;

    /**
     * Throw an exception on the request.
     *
     * @return $this
     */
    public function throw(Closure|Throwable $value): static;

    /**
     * Checks if the response throws an exception.
     */
    public function throwsException(): bool;

    /**
     * Get the exception
     *
     * @param \Saloon\Contracts\PendingRequest $pendingRequest
     */
    public function getException(PendingRequest $pendingRequest): ?Throwable;

    /**
     * Create a new mock response from a fixture
     *
     * @throws \Saloon\Exceptions\DirectoryNotFoundException
     */
    public static function fixture(string $name): Fixture;

    /**
     * Get the response as a ResponseInterface
     */
    public function createPsrResponse(ResponseFactoryInterface $responseFactory, StreamFactoryInterface $streamFactory): ResponseInterface;
}
