<?php

namespace Maxcelos\Acl\Http\Controllers;

use Maxcelos\Acl\Models\Role;
use Maxcelos\Foundation\Http\Controllers\FoundationController;
use Spatie\Permission\Models\Permission;

class RoleController extends FoundationController
{

    function __construct(Role $role)
    {
        parent::__construct($role);
    }

    public function permissions()
    {
        return Permission::all();
    }
}
