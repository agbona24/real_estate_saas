<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\Client;
use App\Models\Lead;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        // Create property categories first
        $categories = [
            ['name' => 'Apartment', 'slug' => 'apartment', 'description' => 'Modern apartments and flats', 'icon' => 'fa-building'],
            ['name' => 'House', 'slug' => 'house', 'description' => 'Single-family houses', 'icon' => 'fa-home'],
            ['name' => 'Villa', 'slug' => 'villa', 'description' => 'Luxury villas', 'icon' => 'fa-hotel'],
            ['name' => 'Commercial', 'slug' => 'commercial', 'description' => 'Commercial properties', 'icon' => 'fa-store'],
            ['name' => 'Land', 'slug' => 'land', 'description' => 'Land and plots', 'icon' => 'fa-map'],
        ];

        foreach ($categories as $category) {
            DB::table('property_categories')->updateOrInsert(
                ['slug' => $category['slug']],
                array_merge($category, ['created_at' => now(), 'updated_at' => now()])
            );
        }

        // Create a demo agency
        $agency = Agency::updateOrCreate(
            ['email' => 'contact@premierestates.com'],
            [
                'name' => 'Premier Estates',
                'slug' => 'premier-estates',
                'email' => 'contact@premierestates.com',
                'phone' => '+1-555-0100',
                'address' => '123 Real Estate Blvd',
                'city' => 'New York',
                'state' => 'NY',
                'country' => 'USA',
                'website' => 'https://premierestates.com',
                'status' => 'active',
                'description' => 'Premier real estate agency specializing in luxury properties',
            ]
        );

        // Update demo users to link them to the agency
        $agencyAdmin = User::where('email', 'agency@demo.com')->first();
        $realtor = User::where('email', 'realtor@demo.com')->first();

        if ($agencyAdmin) {
            $agencyAdmin->update(['tenant_id' => $agency->id]);
        }

        if ($realtor) {
            $realtor->update(['tenant_id' => $agency->id]);
        }

        // Get category IDs
        $apartmentCat = DB::table('property_categories')->where('slug', 'apartment')->first();
        $houseCat = DB::table('property_categories')->where('slug', 'house')->first();
        $villaCat = DB::table('property_categories')->where('slug', 'villa')->first();

        // Create sample properties
        $properties = [
            [
                'tenant_id' => $agency->id,
                'title' => 'Luxury Downtown Apartment',
                'slug' => 'luxury-downtown-apartment',
                'description' => 'Beautiful 2-bedroom apartment in the heart of downtown with stunning city views, modern amenities, and prime location.',
                'category_id' => $apartmentCat->id,
                'type' => 'sale',
                'status' => 'available',
                'price' => 450000,
                'address' => '456 Park Avenue',
                'city' => 'New York',
                'state' => 'NY',
                'country' => 'USA',
                'zip_code' => '10022',
                'bedrooms' => 2,
                'bathrooms' => 2,
                'area' => 1200,
                'area_unit' => 'sqft',
                'year_built' => 2020,
                'created_by' => $realtor ? $realtor->id : 1,
                'is_featured' => true,
                'is_published' => true,
                'amenities' => json_encode(['Gym', 'Pool', 'Parking', 'Concierge', '24/7 Security']),
                'published_at' => now(),
            ],
            [
                'tenant_id' => $agency->id,
                'title' => 'Modern Family House',
                'slug' => 'modern-family-house',
                'description' => 'Spacious 4-bedroom family house with large backyard, perfect for growing families.',
                'category_id' => $houseCat->id,
                'type' => 'sale',
                'status' => 'available',
                'price' => 650000,
                'address' => '789 Maple Street',
                'city' => 'Brooklyn',
                'state' => 'NY',
                'country' => 'USA',
                'zip_code' => '11201',
                'bedrooms' => 4,
                'bathrooms' => 3,
                'area' => 2500,
                'area_unit' => 'sqft',
                'year_built' => 2018,
                'created_by' => $realtor ? $realtor->id : 1,
                'is_featured' => true,
                'is_published' => true,
                'amenities' => json_encode(['Garden', 'Garage', 'Fireplace', 'Modern Kitchen']),
                'published_at' => now(),
            ],
            [
                'tenant_id' => $agency->id,
                'title' => 'Beachfront Villa',
                'slug' => 'beachfront-villa',
                'description' => 'Stunning beachfront villa with private beach access, infinity pool, and breathtaking ocean views.',
                'category_id' => $villaCat->id,
                'type' => 'rent',
                'status' => 'available',
                'price' => 8500,
                'price_period' => 'per month',
                'address' => '321 Ocean Drive',
                'city' => 'Miami',
                'state' => 'FL',
                'country' => 'USA',
                'zip_code' => '33139',
                'bedrooms' => 5,
                'bathrooms' => 4,
                'area' => 4000,
                'area_unit' => 'sqft',
                'year_built' => 2021,
                'created_by' => $realtor ? $realtor->id : 1,
                'is_featured' => true,
                'is_published' => true,
                'amenities' => json_encode(['Private Beach', 'Infinity Pool', 'Home Theater', 'Wine Cellar', 'Smart Home']),
                'published_at' => now(),
            ],
            [
                'tenant_id' => $agency->id,
                'title' => 'Cozy Studio Apartment',
                'slug' => 'cozy-studio-apartment',
                'description' => 'Perfect studio apartment for young professionals, close to public transit.',
                'category_id' => $apartmentCat->id,
                'type' => 'rent',
                'status' => 'rented',
                'price' => 1800,
                'price_period' => 'per month',
                'address' => '555 Broadway',
                'city' => 'New York',
                'state' => 'NY',
                'country' => 'USA',
                'zip_code' => '10012',
                'bedrooms' => 1,
                'bathrooms' => 1,
                'area' => 600,
                'area_unit' => 'sqft',
                'year_built' => 2019,
                'created_by' => $realtor ? $realtor->id : 1,
                'is_featured' => false,
                'is_published' => true,
                'amenities' => json_encode(['WiFi', 'Laundry', 'AC']),
                'published_at' => now(),
            ],
        ];

        foreach ($properties as $property) {
            Property::updateOrCreate(
                ['slug' => $property['slug'], 'tenant_id' => $agency->id],
                $property
            );
        }

        // Create sample leads
        $leads = [
            [
                'tenant_id' => $agency->id,
                'name' => 'John Smith',
                'email' => 'john.smith@example.com',
                'phone' => '+1-555-0101',
                'source' => 'website',
                'status' => 'new',
                'priority' => 'high',
                'assigned_to' => $realtor ? $realtor->id : null,
                'created_by' => $agencyAdmin ? $agencyAdmin->id : 1,
                'notes' => 'Interested in downtown apartments, budget $400k-$500k',
                'budget' => 450000,
                'location_preference' => 'Downtown',
                'property_type_preference' => 'Apartment',
            ],
            [
                'tenant_id' => $agency->id,
                'name' => 'Sarah Johnson',
                'email' => 'sarah.j@example.com',
                'phone' => '+1-555-0102',
                'source' => 'referral',
                'status' => 'contacted',
                'priority' => 'medium',
                'assigned_to' => $realtor ? $realtor->id : null,
                'created_by' => $realtor ? $realtor->id : 1,
                'notes' => 'Looking for family house with good schools nearby',
                'budget' => 600000,
                'location_preference' => 'Brooklyn',
                'property_type_preference' => 'House',
                'last_contacted_at' => now()->subDays(2),
            ],
            [
                'tenant_id' => $agency->id,
                'name' => 'Michael Chen',
                'email' => 'mchen@example.com',
                'phone' => '+1-555-0103',
                'source' => 'social_media',
                'status' => 'qualified',
                'priority' => 'high',
                'assigned_to' => $realtor ? $realtor->id : null,
                'created_by' => $realtor ? $realtor->id : 1,
                'notes' => 'Pre-approved for $700k, ready to buy',
                'budget' => 700000,
                'location_preference' => 'Manhattan',
                'property_type_preference' => 'Apartment',
                'last_contacted_at' => now()->subDays(1),
            ],
        ];

        foreach ($leads as $lead) {
            Lead::create($lead);
        }

        // Create sample clients
        $clientUser = User::where('email', 'client@demo.com')->first();

        $clients = [
            [
                'tenant_id' => $agency->id,
                'user_id' => $clientUser ? $clientUser->id : null,
                'name' => 'Demo Client',
                'email' => 'client@demo.com',
                'phone' => '+1-555-0200',
                'address' => '999 Client Street',
                'city' => 'New York',
                'state' => 'NY',
                'country' => 'USA',
                'type' => 'individual',
                'assigned_to' => $realtor ? $realtor->id : null,
                'status' => 'active',
                'notes' => 'VIP client, owns multiple properties',
            ],
            [
                'tenant_id' => $agency->id,
                'name' => 'Robert Williams',
                'email' => 'robert.w@example.com',
                'phone' => '+1-555-0201',
                'address' => '777 Corporate Ave',
                'city' => 'New York',
                'state' => 'NY',
                'country' => 'USA',
                'type' => 'individual',
                'assigned_to' => $realtor ? $realtor->id : null,
                'status' => 'active',
            ],
        ];

        foreach ($clients as $client) {
            Client::updateOrCreate(
                ['email' => $client['email'], 'tenant_id' => $agency->id],
                $client
            );
        }

        $this->command->info('Demo data created successfully!');
    }
}
