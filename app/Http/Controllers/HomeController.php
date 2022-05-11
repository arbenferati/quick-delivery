<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user() && auth()->user()->userAdmin()) {
            $user = new User();
            $users = $user->getAllUsers();

            $role = new Role();
            $roles = $role->getAllRoles();

            $permission = new Permission();
            $permissions = $permission->getAllPermissions();

            return view('admin.home', compact('users', 'roles', 'permissions'));
        }

        if (auth()->user() && auth()->user()->isSeller()) {

            $user = auth()->user();
            $store = $user->store;
            $products = $store->products;
            $orders = $store->orders;

            return view('home', compact('products', 'orders'));
        }

        return view('home');
    }
}
