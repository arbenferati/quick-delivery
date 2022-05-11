<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'validated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAllUsers()
    {
        return $this::select()->orderBy('validated_at', 'ASC')->get();
    }

    public function getUser($id)
    {
        return $this::findOrFail($id);
    }

    public function createUser(array $data)
    {
        return $this::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function userValidated()
    {
        if ($this->validated_at === NULL) {
            return false;
        }
        return true;
    }


    /**
     * Will validate a user
     */
    public function validateUser()
    {
        $this->update([
            'validated_at' => now()
        ]);
    }

    public function unvalidateUser()
    {
        $this->update([
            'validated_at' => NULL
        ]);
    }

    /**
     * Will destroy a user and his store
     */
    public function destroyUser()
    {
        $store = $this->store;
        $store->destroyStore();
        $role = new Role();
        $roles = $this->roles;

        $role->retractUserFromRoles($this, $roles);

        $this->forceDelete();
    }

    /**
     * Will check if user is admin
     * @return false|true
     */
    public function userAdmin()
    {
        foreach ($this->roles as $role) {
            if ($role->name == 'admin') {
                return true;
            }
        }
        return false;
    }

    /**
     * Will check if user is seller
     * @return false|true
     */
    public function isSeller()
    {
        foreach ($this->roles as $role) {
            if ($role->name == 'vendeur') {
                return true;
            }
        }
        return false;
    }

    /**
     * Fetch the store related to the user
     */
    public function store()
    {
        return $this->hasOne(Store::class);
    }

    /**
     * Fetch the roles related to user
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_has_role');
    }
}
