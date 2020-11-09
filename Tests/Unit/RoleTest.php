<?php

namespace SavageGlobalMarketing\Acl\Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use SavageGlobalMarketing\Acl\Models\Role;
use SavageGlobalMarketing\Acl\Services\Role\CreateRoleService;
use SavageGlobalMarketing\Auth\Models\User;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use DatabaseTransactions;

    private $authUser;

    private $roleService;

    private $tenant;

    function setUp(): void
    {
        parent::setUp();

        $this->authUser = User::factory()->create(['email' => 'admin@email.com']);

        $this->authUser->givePermissionTo([
            'role_create',
            'role_read',
            'role_update',
            'role_destroy',
        ]);
    }

    public function testCreateRole()
    {
        $data = Role::factory()->make()->toArray();

        $this->actingAs($this->authUser, 'api')->json('post', route('savageglobalmarketing.roles.store'), $data)
            ->assertStatus(201);
    }

    public function testListRoles()
    {
        $this->actingAs($this->authUser, 'api')->json('get', route('savageglobalmarketing.roles.index'))
            ->assertStatus(200);
    }

    public function testShowRole()
    {
        $data = Role::factory()->make()->toArray();

        $role = app(CreateRoleService::class)->run($data)->toModel();

        $this->actingAs($this->authUser, 'api')->json('get', route('savageglobalmarketing.roles.show', ['role' => $role->id]))
            ->assertStatus(200);
    }

    public function testUpdateRole()
    {
        $data = Role::factory()->count(2)->make()->toArray();

        $role = app(CreateRoleService::class)->run($data[0])->toModel();

        //$roleUpdated = app(CreateRoleService::class)->run($data[1])->toArray();
        $data[1]['id'] = $role->id;

        $response = $this->actingAs($this->authUser, 'api')->json('put', route('savageglobalmarketing.roles.update', ['role' => $role->id]), $data[1]);

        $response->assertStatus(200);
    }

    public function testDeleteRole()
    {
        $data = Role::factory()->make()->toArray();

        $role = app(CreateRoleService::class)->run($data)->toModel();

        $this->actingAs($this->authUser, 'api')->json('delete', route('savageglobalmarketing.roles.destroy', ['role' => $role->id]))
            ->assertStatus(204);
    }

    public function testCreatePermissionRole()
    {
        $this->authUser->revokePermissionTo('role_create');

        $data =  Role::factory()->make()->toArray();

        $this->actingAs($this->authUser, 'api')->json('post', route('savageglobalmarketing.roles.store'), $data)
            ->assertStatus(403);
    }

    public function testListPermissionRoles()
    {
        $this->authUser->revokePermissionTo('role_read');

        $this->actingAs($this->authUser, 'api')->json('get', route('savageglobalmarketing.roles.index'))
            ->assertStatus(403);
    }

    public function testDeletePermissionRole()
    {
        $this->authUser->revokePermissionTo('role_destroy');

        $data = Role::factory()->count(2)->make()->toArray();

        $role = app(CreateRoleService::class)->run($data[0])->toModel();

        $this->actingAs($this->authUser, 'api')->json('delete', route('savageglobalmarketing.roles.destroy', ['role' => $role->id]))->assertStatus(403);
    }
}
