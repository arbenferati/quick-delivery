<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $table = 'roles';


    /**
     * Will fetch all Roles
     * @return Role
     */
    public function getAllRoles()
    {

    }

    /**
     * Will fetch choosen Role
     * @param $id
     * @return Role
     */
    public function getRole($id)
    {

    }

    /**
     * Will add a permission to the role
     * @param Permission $permission
     */
    public function assignToRole(Permission $permission)
    {

    }


    /**
     * Will remove permission from role
     * @param Permission $permission
     */
    public function retractFromRole(Permission $permission)
    {

    }


    /**
     * Will create a new Role
     * @param array $data
     * @return Role
     */
    public function createRole(array $data)
    {

    }

    /**
     * Will destroy a Role
     */
    public function destroyRole()
    {

    }

    /**
     * Will edit a Role
     * @return Role
     */
    public function editRole()
    {

    }

    /**
     * Will fetch permissions in relation with the role
     * @return ?
     */
    public function permisssions()
    {

    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_has_role', 'role_id', 'id');
    }
}
