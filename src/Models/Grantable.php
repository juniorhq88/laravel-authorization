<?php

declare(strict_types=1);

/**
 * Created on 11/02/18 by enea dhack.
 */

namespace Enea\Authorization\Models;

use Illuminate\Database\Eloquent\Model;

abstract class Grantable extends Model
{
    public function __construct(array $attributes = [])
    {
        $this->setTable($this->getConfigTableName());
        parent::__construct($attributes);
    }

    abstract protected function getConfigTableName(): string;

    public function getFillable()
    {
        return [
            'secret_name',
            'display_name',
            'description'
        ];
    }

    public function __toString()
    {
        return $this->getAttribute('secret_name');
    }
}
