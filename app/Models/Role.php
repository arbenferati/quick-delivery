<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        return $this::all();
    }

    /**
     * Will fetch choosen Role
     * @param $id
     * @return Role
     */
    public function getRole($id)
    {
        return $this::findOrFail($id);
    }

    /**
     * Will fetch choosen Role by using its name
     * @param $name
     * @return Role
     */
    public function getRoleByName($name)
    {
        return $this::where('name', $name)->get()->first();
    }

    /**
     * Will add a permission to the role
     * @param Permission $permission
     */
    public function assignPermissionToRole(Permission $permission)
    {
        $permission->roles->attach($this->id);
    }


    /**
     * Will remove permission from role
     * @param Permission $permission
     */
    public function retractPermissionFromRole(Permission $permission)
    {
        $permission->roles->detach($this->id);
    }

    /**
     * Will remove user from role
     * @param User $user
     * @param $role
     */
    public function retractUserFromRoles(User $user, $roles)
    {
        foreach ($roles as $role) {
            DB::table('user_has_role')->where('user_id', '=', $user->id)->where('role_id', '=', $role->id)->delete();
        }
    }

    /**
     * Will assign the role to a user
     * @param User $user
     */
    public function assignToUser(User $user)
    {
        DB::insert('insert into user_has_role (user_id, role_id, created_at) values (?, ?, ?)', [
            $user->id,
            $this->id,
            now(),
        ]);
    }


    /**
     * Will create a new Role
     * @param array $data
     * @return Role
     */
    public function createRole(array $data)
    {
        return $this->create([
            'name' => $data['name']
        ]);
    }

    /**
     * Will destroy a Role
     */
    public function destroyRole()
    {
        $permissions = $this->permisssions;

        if ($permissions->count() > 0) {
            foreach ($permissions as $permission) {
                $this->retractPermissionFromRole($permission);
            }
        }

        $this->forceDelete();
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
        return $this->belongsToMany(Permission::class, 'role_has_permission', 'role_id', 'id');
    }

    /**
     * Will fetch users in relation with the role
     * @return ?
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_has_role');
    }
}
