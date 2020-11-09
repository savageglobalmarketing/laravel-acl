<?php

namespace SavageGlobalMarketing\Acl\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Modules\Authentication\Traits\HasScope;
use SavageGlobalMarketing\Acl\Database\Factories\RoleFactory;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Role as SpatieRole;

/**
 * @property mixed name
 * @property mixed description
 * @property mixed type
 * @property mixed guard_name
 * @property mixed tenant_id
 */
class Role extends SpatieRole
{
    use SoftDeletes;
    use HasFactory;
    //use HasScope;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'display_name', 'type', 'guard_name',
    ];

    protected $hidden = ['guard_name'];

    public static function create(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? Guard::getDefaultName(static::class);

        if (static::where('name', $attributes['name'])->where('guard_name', $attributes['guard_name'])->first()) {
            throw RoleAlreadyExists::create($attributes['name'], $attributes['guard_name']);
        }

        return static::query()->create($attributes);
    }

    protected static function newFactory()
    {
        return RoleFactory::new();
    }


}
