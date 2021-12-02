<?php


namespace App\Repositories;

use InfyOm\Generator\Common\BaseRepository;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * @method Permission findWithoutFail($id, $columns = ['*'])
 * @method Permission find($id, $columns = ['*'])
 * @method Permission first($columns = ['*'])
 */
class PermissionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'guard_name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Permission::class;
    }

    public function givePermissionToRole(array $input)
    {
        $role = Role::findOrfail($input['roleId']);
        $role->givePermissionTo($input['permission']);
    }

    public function revokePermissionToRole(array $input)
    {
        $role = Role::findOrfail($input['roleId']);
        $role->revokePermissionTo($input['permission']);
    }

    public function roleHasPermission(array $input)
    {
        $role = Role::findOrfail($input['roleId']);
        if ($role->hasPermissionTo($input['permission'])) {
            return ['result' => 1];
        }
        return ['result' => 0];
    }
}
