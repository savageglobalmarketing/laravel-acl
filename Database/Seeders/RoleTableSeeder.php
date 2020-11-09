<?php

namespace Maxcelos\Acl\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Maxcelos\Acl\Models\Role;
use Modules\Authentication\Models\Tenant;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $tableNames = config('permission.table_names');

        $tenant = Tenant::create([
            'name' => 'Default',
            'slug' => 'default'
        ]);

        $roles = [
            [
                'name' => 'admin',
                'description' => 'Admin',
                'type' => 'permissive',
                'guard_name' => 'web',
                'tenant_id' => 1
            ],
            [
                'name' => 'owner',
                'description' => 'Owner',
                'type' => 'permissive',
                'guard_name' => 'web',
                'tenant_id' => 1
            ],
            [
                'name' => 'agent',
                'description' => 'Agent',
                'type' => 'permissive',
                'guard_name' => 'web',
                'tenant_id' => 1
            ],
            [
                'name' => 'owner_free',
                'description' => 'Proprietário [Plano Free]',
                'type' => 'permissive',
                'guard_name' => 'web',
                'tenant_id' => 1
            ],
            [
                'name' => 'owner_standard',
                'description' => 'Proprietário [Plano Standard]',
                'type' => 'permissive',
                'guard_name' => 'web',
                'tenant_id' => 1
            ],
            [
                'name' => 'owner_business',
                'description' => 'Proprietário [Plano Business]',
                'type' => 'permissive',
                'guard_name' => 'web',
                'tenant_id' => 1
            ],
            [
                'name' => 'owner_premium',
                'description' => 'Proprietário [Plano Premium]',
                'type' => 'permissive',
                'guard_name' => 'web',
                'tenant_id' => 1
            ],
            [
                'name' => 'customer',
                'description' => 'Customer',
                'type' => 'permissive',
                'guard_name' => 'web',
                'tenant_id' => 1
            ],
        ];

        Artisan::call('permission:migrate');

        foreach ($roles as $role) {
            Role::create($role);
        }

        Role::where('name', 'admin')->get()->first()->givePermissionTo(Permission::all()->pluck('id')->toArray());

        $ownerRoles = Role::where('name', 'owner_free')
            ->orWhere('name', 'owner_standard')
            ->orWhere('name', 'owner_business')
            ->orWhere('name', 'owner_premium')
            ->orWhere('name', 'owner')
            ->get();

        foreach ($ownerRoles as $ownerRole) {
            $ownerRole->givePermissionTo(Permission::where('name', 'like', 'agent_%')->pluck('id')->toArray());
        }

        DB::table('oauth_clients')->insert([
            [
                'name' => 'Sanchexm CRM Personal Access Client',
                'secret' => 'bdM1H2oTuGJD6Wr8gKuCvIQynT3BUNENuwqXepGz',
                'redirect' => 'http://api.fortoday.loc',
                'personal_access_client' => 1,
                'password_client' => 0,
                'revoked' => 0
            ],
            [
                'name' => 'Sanchexm CRM Password Grant Client',
                'secret' => 'RyVTKFP8wG1FxdcknIbQqi52ZMOFV92rihkWcTFz',
                'redirect' => 'http://api.fortoday.loc',
                'personal_access_client' => 0,
                'password_client' => 1,
                'revoked' => 0
            ]
        ]);
    }
}
