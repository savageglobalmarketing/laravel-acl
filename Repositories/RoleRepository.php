<?php

namespace Maxcelos\Acl\Repositories;

use Maxcelos\Acl\Contracts\RoleContract;
use Maxcelos\Acl\Models\Role;
use Maxcelos\Foundation\Repositories\FoundationRepository;

class RoleRepository extends FoundationRepository implements RoleContract
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
