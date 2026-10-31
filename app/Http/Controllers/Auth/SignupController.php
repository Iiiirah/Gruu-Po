<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SignupController extends Controller
{
    // Para ipakita ang signup form (GET)
    public function create()
    {
        return view('user_signup'); 
    }

    // Para i-process at i-save ang data sa database (POST)
    public function store(Request $request)
    {
        // 1. I-validate ang mga input galing sa form (kasama na ang username at confirm password)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed', // Awtomatikong iche-check kung kapareho ng password_confirmation
        ]);

        // 2. DYNAMIKONG HANAPIN O GAWIN ANG ROLE PARA WALang FOREIGN KEY ERROR
        $roleId = 2; // Default fallback

        if (Schema::hasTable('roles')) {
            try {
                // Subukang i-insert ang ID 1 at 2 kung wala pa
                DB::statement('INSERT IGNORE INTO roles (id) VALUES (1), (2)');
            } catch (\Exception $e) {
                // Sundin kung ano man ang sakaling gumana
            }

            // Kunin ang pinakaunang o tamang role ID mula sa table para iwas mismatch
            $rolesCount = DB::table('roles')->count();
            if ($rolesCount > 0) {
                // Kung mayroon silang record, kunin ang pangalawa kung meron, o ang huli, o ang unang ID
                $allRoleIds = DB::table('roles')->pluck('id')->toArray();
                
                if (in_array(2, $allRoleIds)) {
                    $roleId = 2;
                } elseif (!empty($allRoleIds)) {
                    // Kunin ang huling ID sa listahan (kadalasan ito ang Resident kung Admin ang una)
                    $roleId = end($allRoleIds);
                }
            }
        }

        // 3. I-save ang data sa database kasama ang username at nakuha nating tamang roleId
        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'], // Naitala na ngayon ang username sa database
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $roleId, 
            'user_account' => $validated['email'],
        ]);

        // 4. I-redirect patungo sa login page pagkatapos mag-signup
        return redirect()->route('user.login')->with('success', 'Account created successfully! You can now log in.');
    }
}