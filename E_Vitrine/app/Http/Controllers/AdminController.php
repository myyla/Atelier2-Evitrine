<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;

class AdminController extends Controller
{

    public function viewAll(Request $request)
    {
        return view('backend.admins', ['admins' => User::all()]);
    }

    public function addAdmin(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        $user->save();

        return redirect('/admin/admins');
    }

    public function deleteAdmin($id)
    {
        User::destroy($id);
        return redirect('/admin/admins');
    }
}
