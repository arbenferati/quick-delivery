<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function deleteUser($id)
    {
        if (auth()->user() && auth()->user()->userAdmin()) {
            $user = new User();
            $user = $user->getUser($id);

            $user->destroyUser();

            return redirect()->back()->with('success', 'L\'utilisateur a bien été supprimer');
        }

        return redirect()->back()->with('error', 'Vous n\'avez pas les permissions necessaire pour effectuer cette action');
    }

    public function enableUser($id)
    {
        if (auth()->user() && auth()->user()->userAdmin()) {
            $user = new User();
            $user = $user->getUser($id);

            $user->validateUser();

            return redirect()->back()->with('success', 'L\'utilisateur a été validé');
        }

        return redirect()->back()->with('error', 'Vous n\'avez pas les permissions necessaire pour effectuer cette action');
    }

    public function disableUser($id)
    {
        if (auth()->user() && auth()->user()->userAdmin()) {
            $user = new User();
            $user = $user->getUser($id);

            $user->unvalidateUser();

            return redirect()->back()->with('success', 'L\'utilisateur a été désactiver');
        }

        return redirect()->back()->with('error', 'Vous n\'avez pas les permissions necessaire pour effectuer cette action');
    }
}
