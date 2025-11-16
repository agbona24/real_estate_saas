<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DemoUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin Account
        User::updateOrCreate(
            ['email' => 'admin@demo.com'],
            [
                'name' => 'Super Admin',
                'email' => 'admin@demo.com',
                'password' => Hash::make('password'),
                'role' => 'super_admin',
                'email_verified_at' => now(),
            ]
        );

        // Agency Admin Account
        User::updateOrCreate(
            ['email' => 'agency@demo.com'],
            [
                'name' => 'Agency Admin',
                'email' => 'agency@demo.com',
                'password' => Hash::make('password'),
                'role' => 'agency_admin',
                'email_verified_at' => now(),
            ]
        );

        // Realtor Account
        User::updateOrCreate(
            ['email' => 'realtor@demo.com'],
            [
                'name' => 'John Realtor',
                'email' => 'realtor@demo.com',
                'password' => Hash::make('password'),
                'role' => 'realtor',
                'email_verified_at' => now(),
            ]
        );

        // Client Account
        User::updateOrCreate(
            ['email' => 'client@demo.com'],
            [
                'name' => 'Jane Client',
                'email' => 'client@demo.com',
                'password' => Hash::make('password'),
                'role' => 'client',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('✅ Demo users created successfully!');
        $this->command->info('');
        $this->command->info('Demo Credentials:');
        $this->command->info('─────────────────────────────────────');
        $this->command->info('Super Admin:   admin@demo.com');
        $this->command->info('Agency Admin:  agency@demo.com');
        $this->command->info('Realtor:       realtor@demo.com');
        $this->command->info('Client:        client@demo.com');
        $this->command->info('');
        $this->command->info('Password for all: password');
        $this->command->info('─────────────────────────────────────');
    }
}
