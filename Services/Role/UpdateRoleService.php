<?php

namespace SavageGlobalMarketing\Acl\Services\Role;

use Illuminate\Support\Facades\DB;
use SavageGlobalMarketing\Foundation\Contracts\FoundationContract;
use SavageGlobalMarketing\Foundation\Services\UpdateService;
use SavageGlobalMarketing\Acl\Contracts\RoleContract;

class UpdateRoleService extends UpdateService
{
    public function __construct(RoleContract $repo)
    {
        parent::__construct($repo);
    }

    public function run(array $data): FoundationContract
    {
        DB::beginTransaction();

        parent::run($data);

        if (isset($data['permissions']) && count($data['permissions']))
            $this->repo->toModel()->permissions()->sync($data['permissions']);

        DB::commit();

        return $this->repo;
    }
}
