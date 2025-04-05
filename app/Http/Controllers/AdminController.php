<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.adminDashboard', compact('users'));
    }

    // Approve User
    public function editUser($id)
    {
        $user = User::find($id);

        if ($user && $user->status == 0) {
            $user->status = 1;
            $user->save();
            return redirect()->route('getAdmin')->with('success', 'User status updated successfully!');
        }

        return redirect()->route('getAdmin')->with('success', 'User status updated successfully!');
    }
}
