<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    // 1. Ipakita ang listahan ng mga users
    public function index()
    {
        $users = User::with('role')->get();
        return view('user-management', compact('users'));
    }

    // 2. Magdagdag ng bagong user
public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role_id' => 'required',
        ]);

        User::create([
            'name' => explode('@', $request->email)[0],
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id, // <--- Siguraduhing nandito ito!
            'user_account' => 'USR_' . rand(100, 999),
            'account_status' => 'active',
        ]);

        return redirect()->route('user.management')->with('success', 'User added successfully!');
    }
    
    // 3. Mag-delete ng user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.management')->with('success', 'User deleted successfully!');
    }
}