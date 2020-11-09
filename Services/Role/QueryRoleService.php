<?php

namespace Maxcelos\Acl\Services\Role;

use Maxcelos\Foundation\Services\QueryService;
use Maxcelos\Acl\Contracts\RoleContract;

class QueryRoleService extends QueryService
{
    public function __construct(RoleContract $repo)
    {
        parent::__construct($repo);
    }
}
