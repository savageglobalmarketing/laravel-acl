<?php

namespace Maxcelos\Acl\Services\Role;

use Maxcelos\Foundation\Services\GetService;
use Maxcelos\Acl\Contracts\RoleContract;

class GetRoleService extends GetService
{
    public function __construct(RoleContract $repo)
    {
        parent::__construct($repo);
    }
}
