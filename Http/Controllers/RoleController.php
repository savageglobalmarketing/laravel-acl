<?php

namespace SavageGlobalMarketing\Acl\Http\Controllers;

use SavageGlobalMarketing\Acl\Models\Role;
use SavageGlobalMarketing\Foundation\Http\Controllers\FoundationController;
use Spatie\Permission\Models\Permission;

class RoleController extends FoundationController
{
    protected array $fillable = [
        'name', 'display_name', 'type', 'permissions'
    ];

    function __construct(Role $role)
    {
        parent::__construct($role);
    }

    public function permissions()
    {
        return Permission::all();
    }
}
