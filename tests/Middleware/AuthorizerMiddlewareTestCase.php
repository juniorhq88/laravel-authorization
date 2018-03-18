<?php
/**
 * Created on 17/03/18 by enea dhack.
 */

namespace Enea\Authorization\Tests\Middleware;

use Enea\Authorization\Contracts\Grantable;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Routing\Route;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

abstract class AuthorizerMiddlewareTestCase extends MiddlewareTestCase
{
    const URI = 'authorization-test';

    const SUCCESS_TEXT = 'PASSED';

    abstract protected function getGrantableInstance(string $name): Grantable;

    abstract protected function getMiddlewareName(): string;

    public function test_protect_routes_throw_an_exception(): void
    {
        $this->withoutExceptionHandling();
        $this->authenticate();
        $this->applyMiddleware($this->getMiddlewareName(), 'non-existent-authorization');
        $this->expectException(AccessDeniedHttpException::class);
        $this->makeRequest();
    }

    public function test_the_status_code_of_the_protected_routes_is_403(): void
    {
        $this->authenticate();
        $this->applyMiddleware($this->getMiddlewareName(), 'non-existent-authorization');
        $this->makeRequest()->assertStatus(403);
    }

    public function test_the_route_are_protected_with_an_authorization(): void
    {
        $this->getLoggedUser()->grant($this->getGrantableInstance('authorization.1'));
        $this->applyMiddleware($this->getMiddlewareName(), 'authorization.1');
        $this->makeRequest()->assertStatus(200)->assertSeeText(self::SUCCESS_TEXT);
    }

    public function test_the_route_is_protected_with_some_authorization(): void
    {
        $authorization1 = $this->getGrantableInstance('authorization.1');
        $authorization2 = $this->getGrantableInstance('authorization.2');
        $this->getLoggedUser()->syncGrant([$authorization1, $authorization2]);
        $this->applyMiddleware($this->getMiddlewareName(), 'non-existent', 'authorization.2');
        $this->makeRequest()->assertStatus(200)->assertSeeText(self::SUCCESS_TEXT);
    }

    protected function applyMiddleware(string $middlewareName, string ...$grantables): Route
    {
        return $this->getRouter()->get(self::URI, function () {
            return self::SUCCESS_TEXT;
        })->middleware("{$middlewareName}:" . implode(',', $grantables));
    }

    private function makeRequest(): TestResponse
    {
        return $this->get(self::URI);
    }
}