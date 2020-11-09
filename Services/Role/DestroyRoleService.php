<?php

namespace SavageGlobalMarketing\Acl\Services\Role;

use SavageGlobalMarketing\Foundation\Services\DestroyService;
use SavageGlobalMarketing\Acl\Contracts\RoleContract;

class DestroyRoleService extends DestroyService
{
    public function __construct(RoleContract $repo)
    {
        parent::__construct($repo);
    }
}
