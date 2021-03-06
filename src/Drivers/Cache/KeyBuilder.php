<?php

declare(strict_types=1);

/**
 * @author enea dhack <hello@enea.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Enea\Authorization\Drivers\Cache;

use Enea\Authorization\Contracts\Owner;

class KeyBuilder
{
    public const HASH = 'crc32b';

    public function make(Owner $owner): string
    {
        return "{$this->prefix($owner)}.{$owner->getIdentificationKey()}";
    }

    private function prefix(Owner $owner): string
    {
        return hash(self::HASH, get_class($owner));
    }
}
