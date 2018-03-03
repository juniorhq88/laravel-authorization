<?php
/**
 * Created on 15/02/18 by enea dhack.
 */

namespace Enea\Authorization\Facades;

use Enea\Authorization\Contracts\PermissionContract;
use Enea\Authorization\Contracts\PermissionsOwner;
use Enea\Authorization\Contracts\RoleContract;
use Enea\Authorization\Contracts\RolesOwner;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * Class Revoker.
 *
 * @package Enea\Authorization\Facades
 * @author enea dhack <enea.so@live.com>
 *
 * @method static void permission(PermissionsOwner $owner, PermissionContract $permission)
 * @method static void permissions(PermissionsOwner $owner, Collection $permissions)
 * @method static void role(RolesOwner $owner, RoleContract $role)
 * @method static void roles(RolesOwner $owner, Collection $roles)
 */
class Revoker extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return \Enea\Authorization\Operators\Revoker::class;
    }
}
