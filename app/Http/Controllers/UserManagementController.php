<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUserId = Auth::id();

        // Inuuna si admin@sibul.com, sunod ang kasalukuyang naka-login, tapos ang iba
        $users = User::orderByRaw("CASE WHEN email = 'admin@sibul.com' THEN 1 WHEN id = ? THEN 2 ELSE 3 END", [$currentUserId])
                     ->orderBy('created_at', 'desc')
                     ->get();

        return view('user-management', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Strict Validation: Unique email at unique username sa buong 'users' table (anuman ang role)
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:Admin,Resident',
        ]);

        $inputEmail = strtolower(trim($request->email));
        $inputRole = $request->role;

        // 2. Mahigpit na pagbabawal: Ang 'admin@sibul.com' ay para lamang sa Main Admin
        if ($inputEmail === 'admin@sibul.com' && $inputRole === 'Resident') {
            return back()->withErrors(['email' => 'Ang email na admin@sibul.com ay nakareserba lamang para sa Main Admin at bawal gamitin sa Resident.'])->withInput();
        }

        // 3. Paglikha ng bagong user (One email / One username = One account policy)
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $inputRole,
            'user_account' => 'USR_' . sprintf('%03d', User::max('id') + 1),
            'account_status' => 'active',
        ]);

        return redirect()->route('user.management')->with('success', 'User successfully created!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Proteksyon para hindi mabura ang main admin o ang sarili niyang naka-login account
        if ($user->email === 'admin@sibul.com' || Auth::id() === $user->id) {
            return redirect()->route('user.management')->withErrors(['error' => 'This account cannot be deleted.']);
        }

        $user->delete();

        return redirect()->route('user.management')->with('success', 'User deleted successfully!');
    }
}