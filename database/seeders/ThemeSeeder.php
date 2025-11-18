<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate the table first
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Theme::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $themes = [
            [
                'name' => 'Modern',
                'slug' => 'modern',
                'description' => 'A sleek and contemporary design with clean lines and modern aesthetics. Perfect for agencies targeting urban professionals.',
                'thumbnail' => 'themes/modern-thumbnail.jpg',
                'version' => '1.0.0',
                'author' => 'Real Estate SaaS',
                'is_active' => true,
                'is_default' => true,
                'config' => [
                    'primary_color' => '#3B82F6',
                    'secondary_color' => '#8B5CF6',
                    'accent_color' => '#F59E0B',
                    'text_color' => '#1F2937',
                    'background_color' => '#FFFFFF',
                    'font_family' => 'Inter, sans-serif',
                    'header_style' => 'transparent',
                    'layout' => 'wide',
                    'card_style' => 'shadow',
                    'button_style' => 'rounded',
                    'features' => [
                        'hero_slider' => true,
                        'featured_properties' => true,
                        'search_bar' => true,
                        'testimonials' => true,
                        'team_section' => true,
                        'blog_section' => true,
                        'newsletter' => true,
                    ],
                ],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Classic',
                'slug' => 'classic',
                'description' => 'A timeless and professional design that emphasizes trust and reliability. Ideal for established agencies.',
                'thumbnail' => 'themes/classic-thumbnail.jpg',
                'version' => '1.0.0',
                'author' => 'Real Estate SaaS',
                'is_active' => true,
                'is_default' => false,
                'config' => [
                    'primary_color' => '#1E40AF',
                    'secondary_color' => '#DC2626',
                    'accent_color' => '#059669',
                    'text_color' => '#374151',
                    'background_color' => '#F9FAFB',
                    'font_family' => 'Georgia, serif',
                    'header_style' => 'solid',
                    'layout' => 'boxed',
                    'card_style' => 'bordered',
                    'button_style' => 'square',
                    'features' => [
                        'hero_slider' => true,
                        'featured_properties' => true,
                        'search_bar' => true,
                        'testimonials' => true,
                        'team_section' => true,
                        'blog_section' => false,
                        'newsletter' => true,
                    ],
                ],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Luxury',
                'slug' => 'luxury',
                'description' => 'An elegant and sophisticated design for high-end properties. Features premium aesthetics and refined details.',
                'thumbnail' => 'themes/luxury-thumbnail.jpg',
                'version' => '1.0.0',
                'author' => 'Real Estate SaaS',
                'is_active' => true,
                'is_default' => false,
                'config' => [
                    'primary_color' => '#0F172A',
                    'secondary_color' => '#B8860B',
                    'accent_color' => '#C0C0C0',
                    'text_color' => '#1E293B',
                    'background_color' => '#FFFFFF',
                    'font_family' => 'Playfair Display, serif',
                    'header_style' => 'transparent',
                    'layout' => 'wide',
                    'card_style' => 'minimal',
                    'button_style' => 'pill',
                    'features' => [
                        'hero_slider' => true,
                        'featured_properties' => true,
                        'search_bar' => false,
                        'testimonials' => true,
                        'team_section' => true,
                        'blog_section' => true,
                        'newsletter' => true,
                    ],
                ],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Minimal',
                'slug' => 'minimal',
                'description' => 'A clean and minimalist design that puts the focus on your properties. Simple yet effective.',
                'thumbnail' => 'themes/minimal-thumbnail.jpg',
                'version' => '1.0.0',
                'author' => 'Real Estate SaaS',
                'is_active' => true,
                'is_default' => false,
                'config' => [
                    'primary_color' => '#000000',
                    'secondary_color' => '#6B7280',
                    'accent_color' => '#10B981',
                    'text_color' => '#111827',
                    'background_color' => '#FFFFFF',
                    'font_family' => 'Helvetica Neue, sans-serif',
                    'header_style' => 'minimal',
                    'layout' => 'wide',
                    'card_style' => 'flat',
                    'button_style' => 'rounded',
                    'features' => [
                        'hero_slider' => false,
                        'featured_properties' => true,
                        'search_bar' => true,
                        'testimonials' => false,
                        'team_section' => false,
                        'blog_section' => false,
                        'newsletter' => true,
                    ],
                ],
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($themes as $theme) {
            Theme::create($theme);
        }

        $this->command->info('Themes seeded successfully!');
    }
}
