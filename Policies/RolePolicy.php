<?php

namespace SavageGlobalMarketing\Acl\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use SavageGlobalMarketing\Acl\Models\Role;
use SavageGlobalMarketing\Auth\Models\User;

class RolePolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        //dd($user->getAllPermissions()->toArray());
        return $user->can('role_read');
    }

    public function create(User $user)
    {
        return $user->can('role_create');
    }

    public function view(User $user, Role $role)
    {
        return $user->can('role_read');
    }

    public function update(User $user, Role $role)
    {
        return $user->can('role_update') && $role->name != 'owner';
    }

    public function delete(User $user, Role $role)
    {
        return $user->can('role_destroy') && $role->name != 'owner';
    }
}
