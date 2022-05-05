<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    }

    /**
     * Will fetch choosen permission
     * @param $id
     * @return Permission
     */
    public function getPermission($id)
    {

    }

    /**
     * Will assign a permission to a role
     * @param Role $role
     */
    public function assignToRole(Role $role)
    {

    }


    /**
     * Will retract a permission from a role
     * @param Role $role
     */
    public function retractFromRole(Role $role)
    {

    }


    /**
     * Will create a new permission
     * @param array $data
     * @return Permission
     */
    public function createPermission(array $data)
    {

    }

    /**
     * Will destroy a permission
     */
    public function destroyPermission()
    {

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

    }

}
