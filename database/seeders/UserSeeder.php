<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate the table first
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $users = [
            [
                'tenant_id' => null, // Super admin doesn't belong to a tenant
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'phone' => '+234 800 123 4567',
                'avatar' => null,
                'role' => 'super_admin',
                'is_active' => true,
                'permissions' => [
                    'manage_agencies',
                    'manage_plans',
                    'manage_themes',
                    'view_analytics',
                    'manage_settings',
                    'manage_users',
                ],
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenant_id' => 1, // Belongs to Prime Realty
                'first_name' => 'Agency',
                'last_name' => 'Administrator',
                'email' => 'agency@example.com',
                'password' => Hash::make('password'),
                'phone' => '+234 801 234 5678',
                'avatar' => null,
                'role' => 'agency_admin',
                'is_active' => true,
                'permissions' => [
                    'manage_properties',
                    'manage_realtors',
                    'manage_branches',
                    'manage_clients',
                    'manage_leads',
                    'view_reports',
                    'manage_settings',
                ],
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenant_id' => 1, // Belongs to Prime Realty
                'first_name' => 'John',
                'last_name' => 'Realtor',
                'email' => 'realtor@example.com',
                'password' => Hash::make('password'),
                'phone' => '+234 802 345 6789',
                'avatar' => null,
                'role' => 'realtor',
                'is_active' => true,
                'permissions' => [
                    'create_properties',
                    'edit_own_properties',
                    'manage_own_leads',
                    'manage_own_clients',
                    'view_reports',
                ],
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenant_id' => 1, // Belongs to Prime Realty
                'first_name' => 'Jane',
                'last_name' => 'Client',
                'email' => 'client@example.com',
                'password' => Hash::make('password'),
                'phone' => '+234 803 456 7890',
                'avatar' => null,
                'role' => 'client',
                'is_active' => true,
                'permissions' => [
                    'view_properties',
                    'save_favorites',
                    'submit_inquiries',
                ],
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenant_id' => 1, // Belongs to Prime Realty
                'first_name' => 'Sarah',
                'last_name' => 'Johnson',
                'email' => 'sarah.johnson@primerealty.com',
                'password' => Hash::make('password'),
                'phone' => '+234 804 567 8901',
                'avatar' => null,
                'role' => 'realtor',
                'is_active' => true,
                'permissions' => [
                    'create_properties',
                    'edit_own_properties',
                    'manage_own_leads',
                    'manage_own_clients',
                    'view_reports',
                ],
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tenant_id' => 2, // Belongs to Urban Estates
                'first_name' => 'Michael',
                'last_name' => 'Brown',
                'email' => 'michael@urbanestates.com',
                'password' => Hash::make('password'),
                'phone' => '+234 805 678 9012',
                'avatar' => null,
                'role' => 'agency_admin',
                'is_active' => true,
                'permissions' => [
                    'manage_properties',
                    'manage_realtors',
                    'manage_branches',
                    'manage_clients',
                    'manage_leads',
                    'view_reports',
                    'manage_settings',
                ],
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        $this->command->info('Users seeded successfully!');
        $this->command->info('Demo Credentials:');
        $this->command->info('  Super Admin: admin@example.com / password');
        $this->command->info('  Agency Admin: agency@example.com / password');
        $this->command->info('  Realtor: realtor@example.com / password');
        $this->command->info('  Client: client@example.com / password');
    }
}
