<?php
/**
 * Created on 17/02/18 by enea dhack.
 */

namespace Enea\Authorization\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface RolesOwner extends GrantableOwner
{
    public function roles(): BelongsToMany;
}
