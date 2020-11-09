<?php

namespace Maxcelos\Acl\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Maxcelos\Acl\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $permissions = Permission::all()->take(10)->pluck('id')->toArray();

        return [
            'name' => $this->faker->slug,
            'display_name' => $this->faker->name,
            'type' => $this->faker->randomElement(['permissive', 'prohibitive']),
            'permissions' => $this->faker->randomElements($permissions, 3)
        ];
    }
}
