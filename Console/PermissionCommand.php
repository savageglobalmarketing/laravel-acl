<?php

namespace SavageGlobalMarketing\Acl\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use SavageGlobalMarketing\Acl\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'permission:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed permissions from config file';

    /**
     * Default actions for any non strict permission
     *
     * @var array
     */
    protected $defaultActions;

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->migratePermissions();

        $this->updateSuperUserPermissions();
    }

    /**
     * List actions to specific permission
     *
     * @param $permission string|array
     *
     * @return array
     */
    private function getActions($permission)
    {
        if (isset($permission['strict']) && $permission['strict'] == true) {
            return $permission['actions'];
        } elseif (is_array($permission)) {
            return array_merge($this->defaultActions, $permission['actions']);
        } elseif (is_string($permission)) {
            return $this->defaultActions;
        } else {
            throw new \Exception(); // TODO: Customize exception
        }
    }

    /**
     * Count the number of unique permissions
     *
     */
    private function countPermissions($permissions, $default)
    {
        $count = 0;

        foreach($permissions as $permission) {

            if (is_string($permission)) {
                $count += $default;
            } elseif (isset($permission['actions'])) {
                $count += count($permission['actions']);

                if (!isset($permission['strict']) || $permission['strict'] == false) {
                    $count += $default;
                }
            }
        }

        return $count;
    }

    public function migratePermissions()
    {
        $this->defaultActions = config('acl.default_actions');

        $permissions = config('acl.permissions');

        $total = $this->countPermissions($permissions, count($this->defaultActions));

        $this->warn('Updating permissions...');

        $bar = $this->startProgressBar($total);

        $stored = [];

        foreach ($permissions as $key => $permission) {
            $name = is_string($permission) ? $permission : $key;

            $actions = $this->getActions($permission);

            foreach ($actions as $action) {
                $stored[] = Permission::firstOrCreate([
                    'name' => $name . '_' . $action
                ])->name;

                $bar->advance();
            }
        }

        Permission::query()->orWhereNotIn('name', $stored)->delete();

        $bar->finish();

        $this->line('');

        $this->info('Permissions updated successfully');
    }

    public function startProgressBar($total)
    {
        $bar = $this->output->createProgressBar($total + 1);

        $bar->setFormat('Progress: [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');

        $bar->start();

        return $bar;
    }

    public function updateSuperUserPermissions()
    {
        $this->warn('Updating admin permissions...');

        $tableNames = config('permission.table_names');

        /*$superUserClass = config('acl.admin.class');

        $superUser = $superUserClass::where(config('acl.admin.username_field'), config('acl.admin.username'))->first();

        if ($superUser) {
            $superUser->givePermissionTo(Permission::all()->pluck('name')->toArray());

            $this->info('Admin permissions updated');
        } else {
            $this->error(' No admin found ');
        }*/


        $superUserRoles = DB::table($tableNames['roles'])->select('name')->where('name', config('acl.admin_role'))->get();

        foreach ($superUserRoles as $superUserRole) {
            $superUserRole->givePermissionTo(Permission::all()->pluck('name')->toArray());
        }

    }
}
