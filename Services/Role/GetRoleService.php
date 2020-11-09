<?php

namespace SavageGlobalMarketing\Acl\Services\Role;

use SavageGlobalMarketing\Foundation\Services\GetService;
use SavageGlobalMarketing\Acl\Contracts\RoleContract;

class GetRoleService extends GetService
{
    public function __construct(RoleContract $repo)
    {
        parent::__construct($repo);
    }
}
