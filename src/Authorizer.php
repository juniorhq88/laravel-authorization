<?php
/**
 * Created on 21/02/18 by enea dhack.
 */

namespace Enea\Authorization;

use Enea\Authorization\Contracts\{
    PermissionsOwner, RolesOwner
};

interface Authorizer
{
    public function can(PermissionsOwner $owner, string $permission): bool;

    public function syncCan(PermissionsOwner $owner, array $permissions): bool;

    public function is(RolesOwner $owner, string $role): bool;

    public function syncIs(RolesOwner $owner, array $roles): bool;
}
