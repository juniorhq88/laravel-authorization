<?php
/**
 * Created on 07/03/18 by enea dhack.
 */

namespace Enea\Authorization\Drivers\Database;

use Enea\Authorization\Contracts\RolesOwner;

class RoleEvaluator extends Evaluator
{
    public function evaluate(RolesOwner $owner, string $role): bool
    {
        return $this->syncEvaluate($owner, [$role]);
    }

    public function syncEvaluate(RolesOwner $owner, array $roles): bool
    {
        return $this->has($owner->roles()->getQuery())($roles);
    }
}
