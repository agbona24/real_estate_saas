<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\AgencyBranch;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate the tables first
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        AgencyBranch::truncate();
        Agency::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create agencies
        $agencies = [
            [
                'id' => 1,
                'name' => 'Prime Realty',
                'slug' => 'prime-realty',
                'email' => 'info@primerealty.com',
                'phone' => '+234 800 111 2222',
                'logo' => null,
                'address' => '123 Victoria Island Road',
                'city' => 'Lagos',
                'state' => 'Lagos',
                'country' => 'Nigeria',
                'zip_code' => '101001',
                'website' => 'https://primerealty.com',
                'description' => 'Prime Realty is a leading real estate agency in Nigeria, specializing in luxury residential and commercial properties. With over 15 years of experience, we provide exceptional service to buyers, sellers, and investors.',
                'status' => 'active',
                'subdomain' => 'primerealty',
                'custom_domain' => null,
                'settings' => [
                    'theme_id' => 1,
                    'currency' => 'NGN',
                    'timezone' => 'Africa/Lagos',
                    'language' => 'en',
                    'allow_inquiries' => true,
                    'require_login' => false,
                    'auto_approve_properties' => false,
                    'email_notifications' => true,
                    'sms_notifications' => true,
                    'social_media' => [
                        'facebook' => 'https://facebook.com/primerealty',
                        'twitter' => 'https://twitter.com/primerealty',
                        'instagram' => 'https://instagram.com/primerealty',
                        'linkedin' => 'https://linkedin.com/company/primerealty',
                    ],
                ],
                'subscribed_at' => now()->subMonths(3),
                'subscription_expires_at' => now()->addMonths(9),
                'created_at' => now()->subMonths(3),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Urban Estates',
                'slug' => 'urban-estates',
                'email' => 'contact@urbanestates.com',
                'phone' => '+234 800 333 4444',
                'logo' => null,
                'address' => '456 Central Business District',
                'city' => 'Abuja',
                'state' => 'FCT',
                'country' => 'Nigeria',
                'zip_code' => '900001',
                'website' => 'https://urbanestates.com',
                'description' => 'Urban Estates focuses on modern urban living solutions. We specialize in apartments, condos, and mixed-use developments in major Nigerian cities.',
                'status' => 'active',
                'subdomain' => 'urbanestates',
                'custom_domain' => null,
                'settings' => [
                    'theme_id' => 2,
                    'currency' => 'NGN',
                    'timezone' => 'Africa/Lagos',
                    'language' => 'en',
                    'allow_inquiries' => true,
                    'require_login' => false,
                    'auto_approve_properties' => true,
                    'email_notifications' => true,
                    'sms_notifications' => false,
                    'social_media' => [
                        'facebook' => 'https://facebook.com/urbanestates',
                        'instagram' => 'https://instagram.com/urbanestates',
                    ],
                ],
                'subscribed_at' => now()->subMonths(1),
                'subscription_expires_at' => now()->addMonths(11),
                'created_at' => now()->subMonths(1),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Coastal Properties',
                'slug' => 'coastal-properties',
                'email' => 'hello@coastalproperties.com',
                'phone' => '+234 800 555 6666',
                'logo' => null,
                'address' => '789 Beach Road',
                'city' => 'Port Harcourt',
                'state' => 'Rivers',
                'country' => 'Nigeria',
                'zip_code' => '500001',
                'website' => 'https://coastalproperties.com',
                'description' => 'Coastal Properties specializes in waterfront and coastal real estate. From beach houses to marina apartments, we offer the finest properties along Nigeria\'s beautiful coastline.',
                'status' => 'active',
                'subdomain' => 'coastal',
                'custom_domain' => null,
                'settings' => [
                    'theme_id' => 3,
                    'currency' => 'NGN',
                    'timezone' => 'Africa/Lagos',
                    'language' => 'en',
                    'allow_inquiries' => true,
                    'require_login' => false,
                    'auto_approve_properties' => false,
                    'email_notifications' => true,
                    'sms_notifications' => true,
                    'social_media' => [
                        'facebook' => 'https://facebook.com/coastalproperties',
                        'instagram' => 'https://instagram.com/coastalproperties',
                    ],
                ],
                'subscribed_at' => now()->subWeeks(2),
                'subscription_expires_at' => now()->addMonths(11)->addWeeks(2),
                'created_at' => now()->subWeeks(2),
                'updated_at' => now(),
            ],
        ];

        foreach ($agencies as $agencyData) {
            Agency::create($agencyData);
        }

        // Create branches for each agency
        $branches = [
            // Prime Realty branches
            [
                'agency_id' => 1,
                'name' => 'Prime Realty - Victoria Island',
                'email' => 'vi@primerealty.com',
                'phone' => '+234 800 111 2223',
                'address' => '123 Victoria Island Road',
                'city' => 'Lagos',
                'state' => 'Lagos',
                'country' => 'Nigeria',
                'zip_code' => '101001',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_id' => 1,
                'name' => 'Prime Realty - Lekki',
                'email' => 'lekki@primerealty.com',
                'phone' => '+234 800 111 2224',
                'address' => '45 Lekki Phase 1',
                'city' => 'Lagos',
                'state' => 'Lagos',
                'country' => 'Nigeria',
                'zip_code' => '101245',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_id' => 1,
                'name' => 'Prime Realty - Ikoyi',
                'email' => 'ikoyi@primerealty.com',
                'phone' => '+234 800 111 2225',
                'address' => '78 Bourdillon Road',
                'city' => 'Lagos',
                'state' => 'Lagos',
                'country' => 'Nigeria',
                'zip_code' => '101233',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Urban Estates branches
            [
                'agency_id' => 2,
                'name' => 'Urban Estates - Abuja Central',
                'email' => 'central@urbanestates.com',
                'phone' => '+234 800 333 4445',
                'address' => '456 Central Business District',
                'city' => 'Abuja',
                'state' => 'FCT',
                'country' => 'Nigeria',
                'zip_code' => '900001',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_id' => 2,
                'name' => 'Urban Estates - Maitama',
                'email' => 'maitama@urbanestates.com',
                'phone' => '+234 800 333 4446',
                'address' => '12 Maitama District',
                'city' => 'Abuja',
                'state' => 'FCT',
                'country' => 'Nigeria',
                'zip_code' => '900271',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Coastal Properties branches
            [
                'agency_id' => 3,
                'name' => 'Coastal Properties - Port Harcourt',
                'email' => 'ph@coastalproperties.com',
                'phone' => '+234 800 555 6667',
                'address' => '789 Beach Road',
                'city' => 'Port Harcourt',
                'state' => 'Rivers',
                'country' => 'Nigeria',
                'zip_code' => '500001',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'agency_id' => 3,
                'name' => 'Coastal Properties - Marina',
                'email' => 'marina@coastalproperties.com',
                'phone' => '+234 800 555 6668',
                'address' => '23 Marina Boulevard',
                'city' => 'Port Harcourt',
                'state' => 'Rivers',
                'country' => 'Nigeria',
                'zip_code' => '500012',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($branches as $branchData) {
            AgencyBranch::create($branchData);
        }

        $this->command->info('Agencies and branches seeded successfully!');
    }
}
