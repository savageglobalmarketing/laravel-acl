<?php

namespace Maxcelos\Acl\Services\Role;

use Illuminate\Support\Facades\DB;
use Maxcelos\Foundation\Contracts\FoundationContract;
use Maxcelos\Foundation\Services\CreateService;
use Maxcelos\Acl\Contracts\RoleContract;

class CreateRoleService extends CreateService
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
