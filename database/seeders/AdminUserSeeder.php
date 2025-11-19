<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('Admin@2025!'),
                'is_admin' => true,
                'role' => 'admin',
                'email_verified_at' => now(),
                'last_login_at' => null,
                'avatar' => null,
            ]
        );

        // Create Editor
        User::updateOrCreate(
            ['email' => 'editor@gmail.com'],
            [
                'name' => 'Content Editor',
                'password' => Hash::make('Editor@2025!'),
                'is_admin' => true,
                'role' => 'editor',
                'email_verified_at' => now(),
                'last_login_at' => null,
                'avatar' => null,
            ]
        );

        // Create Viewer
        User::updateOrCreate(
            ['email' => 'viewer@gmail.com'],
            [
                'name' => 'Content Viewer',
                'password' => Hash::make('Viewer@2025!'),
                'is_admin' => true,
                'role' => 'viewer',
                'email_verified_at' => now(),
                'last_login_at' => null,
                'avatar' => null,
            ]
        );

        $this->command->info('✅ Admin users created successfully!');
        $this->command->newLine();
        $this->command->info('📋 Login Credentials:');
        $this->command->info('══════════════════════════════════════════');
        $this->command->newLine();
        
        $this->command->info('🔐 SUPER ADMIN:');
        $this->command->info('   Email: admin@gmail.com');
        $this->command->info('   Password: Admin@2025!');
        $this->command->newLine();
        
        $this->command->info('✏️  EDITOR:');
        $this->command->info('   Email: editor@gmail.com');
        $this->command->info('   Password: Editor@2025!');
        $this->command->newLine();
        
        $this->command->info('👁️  VIEWER:');
        $this->command->info('   Email: viewer@gmail.com');
        $this->command->info('   Password: Viewer@2025!');
        $this->command->newLine();
        
        $this->command->warn('⚠️  IMPORTANT: Change these passwords in production!');
        $this->command->newLine();
        $this->command->info('🌐 Admin URL: http://localhost:8000/admin/login');
    }
}

