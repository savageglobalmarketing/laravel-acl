<?php

namespace Maxcelos\Acl\Services\Role;

use Maxcelos\Foundation\Services\DestroyService;
use Maxcelos\Acl\Contracts\RoleContract;

class DestroyRoleService extends DestroyService
{
    public function __construct(RoleContract $repo)
    {
        parent::__construct($repo);
    }
}
