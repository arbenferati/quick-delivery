<?php

namespace App\Http\Controllers;

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

            return view('admin.home', compact('users'));
        }
        return view('home');
    }
}
