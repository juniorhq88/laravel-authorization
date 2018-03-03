<?php
/**
 * Created on 12/02/18 by enea dhack.
 */

namespace Enea\Authorization\Operators;

use Closure;
use Enea\Authorization\Contracts\Grantable;
use Enea\Authorization\Contracts\PermissionContract;
use Enea\Authorization\Contracts\PermissionsOwner;
use Enea\Authorization\Contracts\RoleContract;
use Enea\Authorization\Contracts\RolesOwner;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Revoker extends Modifier
{
    public function permission(PermissionsOwner $owner, PermissionContract $permission): void
    {
        $this->revokeOn($owner->permissions())($permission);
    }

    public function role(RolesOwner $owner, RoleContract $role): void
    {
        $this->revokeOn($owner->roles())($role);
    }

    private function revokeOn(BelongsToMany $authorizations): Closure
    {
        return function (Grantable $grantable) use ($authorizations): bool {
            $saved = $this->isSuccessful($authorizations->detach($this->castToModel($grantable)));
            $this->throwErrorIfNotSaved($saved, $grantable);
        };
    }

    private function isSuccessful(int $results): bool
    {
        return $results > 0;
    }
}
