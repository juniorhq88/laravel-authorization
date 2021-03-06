<?php

declare(strict_types=1);

/**
 * @author enea dhack <me@enea.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Enea\Authorization\Middleware;

use Enea\Authorization\Facades\Authenticated;

class RoleAuthorizerMiddleware extends AuthorizerMiddleware
{
    protected function authorized(array $grantable): void
    {
        Authenticated::is(...$grantable);
    }
}
