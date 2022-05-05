<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $table = 'permissions';

    /**
     * Will fetch all permissions
     * @return Permission
     */
    public function getAllPermissions()
    {
        return $this::all();
    }

    /**
     * Will fetch choosen permission
     * @param $id
     * @return Permission
     */
    public function getPermission($id)
    {
        return $this::findOrFail($id);
    }

    /**
     * Will assign a permission to a role
     * @param Role $role
     */
    public function assignToRole(Role $role)
    {
        $role->permisssions->attach($this->id);
    }


    /**
     * Will retract a permission from a role
     * @param Role $role
     */
    public function retractFromRole(Role $role)
    {
        $role->permisssions->detach($this->id);
    }


    /**
     * Will create a new permission
     * @param array $data
     * @return Permission
     */
    public function createPermission(array $data)
    {
        return $this->create([
            'name' => $data['name'],
        ]);
    }

    /**
     * Will destroy a permission
     */
    public function destroyPermission()
    {
        $roles = $this->roles;

        if ($roles->count() > 0) {
            foreach ($roles as $role) {
                $this->retractFromRole($role);
            }
        }

        $this->forceDelete();
    }

    /**
     * Will edit a permission
     * @return Permission
     */
    public function editPermission()
    {

    }

    /**
     * Will fetch roles in relation with the permisssion
     * @return ?
     */
    public function roles()
    {
        $this->belongsToMany(Role::class, 'role_has_permission', 'permission_id', 'id');
    }

}
