<?php

namespace SavageGlobalMarketing\Acl\Repositories;

use SavageGlobalMarketing\Acl\Contracts\RoleContract;
use SavageGlobalMarketing\Acl\Models\Role;
use SavageGlobalMarketing\Foundation\Repositories\FoundationRepository;

class RoleRepository extends FoundationRepository implements RoleContract
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
