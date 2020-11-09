<?php

namespace SavageGlobalMarketing\Acl\Services\Role;

use SavageGlobalMarketing\Foundation\Services\QueryService;
use SavageGlobalMarketing\Acl\Contracts\RoleContract;

class QueryRoleService extends QueryService
{
    public function __construct(RoleContract $repo)
    {
        parent::__construct($repo);
    }
}
