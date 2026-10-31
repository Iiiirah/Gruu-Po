<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Pansamantalang i-off ang foreign key checks
        Schema::disableForeignKeyConstraints();

        // Linisin muna natin o i-try i-insert nang walang anumang timestamps gamit ang raw insert / ignore kung nag-eexist na
        if (Schema::hasTable('roles')) {
            // Gumamit tayo ng try-catch o raw SQL insert para sigurado at walang timestamps na hahanapin
            try {
                DB::statement('INSERT IGNORE INTO roles (id) VALUES (1), (2)');
            } catch (\Exception $e) {
                // Fallback kung sakaling mag-error sa ibang database driver
                DB::table('roles')->insertOrIgnore([
                    ['id' => 1],
                    ['id' => 2],
                ]);
            }
        }

        // I-create o i-update ang Admin user kasama ang role_id = 1
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'System Admin',
                'email' => 'admin@sibul.com',
                'password' => Hash::make('admin123'),
                'role_id' => 1,
                'user_account' => 'admin',
            ]
        );

        // I-on ulit ang foreign key checks
        Schema::enableForeignKeyConstraints();
    }
}