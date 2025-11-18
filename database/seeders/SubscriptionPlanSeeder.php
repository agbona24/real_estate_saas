<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate the table first
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        SubscriptionPlan::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $plans = [
            [
                'name' => 'Starter',
                'slug' => 'starter',
                'description' => 'Perfect for small agencies and independent realtors starting their journey.',
                'price' => 29.00,
                'interval' => 'monthly',
                'trial_days' => 14,
                'max_realtors' => 5,
                'max_properties' => 50,
                'max_branches' => 1,
                'is_active' => true,
                'is_featured' => false,
                'features' => [
                    'Up to 5 realtors',
                    'Up to 50 active properties',
                    '1 branch location',
                    'Basic property management',
                    'Lead capture forms',
                    'Email notifications',
                    'Mobile responsive website',
                    'Basic analytics',
                    'Email support',
                ],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Professional',
                'slug' => 'professional',
                'description' => 'Ideal for growing agencies with multiple realtors and expanding property portfolios.',
                'price' => 79.00,
                'interval' => 'monthly',
                'trial_days' => 14,
                'max_realtors' => 15,
                'max_properties' => 200,
                'max_branches' => 3,
                'is_active' => true,
                'is_featured' => true,
                'features' => [
                    'Up to 15 realtors',
                    'Up to 200 active properties',
                    'Up to 3 branch locations',
                    'Advanced property management',
                    'Lead management & tracking',
                    'Email & SMS notifications',
                    'Custom domain support',
                    'Advanced analytics & reports',
                    'Document management',
                    'Transaction tracking',
                    'Priority email support',
                    'Remove platform branding',
                ],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Enterprise',
                'slug' => 'enterprise',
                'description' => 'For established agencies requiring unlimited resources and premium features.',
                'price' => 199.00,
                'interval' => 'monthly',
                'trial_days' => 30,
                'max_realtors' => -1, // -1 represents unlimited
                'max_properties' => -1,
                'max_branches' => -1,
                'is_active' => true,
                'is_featured' => true,
                'features' => [
                    'Unlimited realtors',
                    'Unlimited properties',
                    'Unlimited branch locations',
                    'Everything in Professional',
                    'API access',
                    'White-label solution',
                    'Custom integrations',
                    'Dedicated account manager',
                    'Phone & priority support',
                    'Custom training sessions',
                    'Advanced security features',
                    'Multi-language support',
                    'Custom workflows',
                ],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Custom',
                'slug' => 'custom',
                'description' => 'Tailored solutions for agencies with specific needs and custom requirements.',
                'price' => 0.00, // Custom pricing
                'interval' => 'monthly',
                'trial_days' => 0,
                'max_realtors' => -1,
                'max_properties' => -1,
                'max_branches' => -1,
                'is_active' => true,
                'is_featured' => false,
                'features' => [
                    'Everything in Enterprise',
                    'Custom feature development',
                    'Dedicated infrastructure',
                    'SLA guarantees',
                    'Custom branding & theming',
                    'On-premise deployment option',
                    'Custom contract terms',
                    '24/7 Premium support',
                    'Dedicated development team',
                    'Quarterly business reviews',
                ],
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($plans as $plan) {
            SubscriptionPlan::create($plan);
        }

        $this->command->info('Subscription plans seeded successfully!');
    }
}
