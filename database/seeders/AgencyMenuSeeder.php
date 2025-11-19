<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class AgencyMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first agency (or create a demo one)
        $agency = Agency::first();

        if (!$agency) {
            // Create a demo agency if none exists
            $agency = Agency::create([
                'name' => 'Demo Real Estate Agency',
                'slug' => 'demo-real-estate-agency',
                'email' => 'admin@demorealestate.com',
                'phone' => '+1234567890',
                'address' => '123 Real Estate Street',
                'status' => 'active',
            ]);
        }

        // Create the sidebar menu for agency portal
        $sidebarMenu = Menu::create([
            'tenant_id' => $agency->id,
            'name' => 'Agency Portal Sidebar',
            'location' => 'sidebar',
            'is_active' => true,
        ]);

        // Define the menu structure
        $menuStructure = $this->getAgencyMenuStructure();

        // Create menu items
        $this->createMenuItems($sidebarMenu->id, $menuStructure);
    }

    /**
     * Get the agency portal menu structure.
     */
    private function getAgencyMenuStructure(): array
    {
        return [
            [
                'label' => 'Dashboard',
                'url' => '/agency/dashboard',
                'icon' => 'home',
                'sort_order' => 1,
                'children' => [
                    ['label' => 'Overview', 'url' => '/agency/dashboard/overview', 'sort_order' => 1],
                    ['label' => 'Sales Pipeline', 'url' => '/agency/dashboard/sales-pipeline', 'sort_order' => 2],
                    ['label' => 'Quick Stats', 'url' => '/agency/dashboard/quick-stats', 'sort_order' => 3],
                    ['label' => 'Recent Activities', 'url' => '/agency/dashboard/activities', 'sort_order' => 4],
                    ['label' => 'Notifications', 'url' => '/agency/dashboard/notifications', 'sort_order' => 5],
                ],
            ],
            [
                'label' => 'Team Management',
                'url' => '/agency/team',
                'icon' => 'users',
                'sort_order' => 2,
                'children' => [
                    ['label' => 'Realtors / Agents', 'url' => '/agency/team/realtors', 'sort_order' => 1],
                    ['label' => 'Team Performance', 'url' => '/agency/team/performance', 'sort_order' => 2],
                    ['label' => 'Roles & Permissions', 'url' => '/agency/team/roles', 'sort_order' => 3],
                    ['label' => 'Activity Logs', 'url' => '/agency/team/activity-logs', 'sort_order' => 4],
                ],
            ],
            [
                'label' => 'CRM & Engagement',
                'url' => '/agency/crm',
                'icon' => 'trending-up',
                'sort_order' => 3,
                'children' => [
                    ['label' => 'Leads', 'url' => '/agency/crm/leads', 'sort_order' => 1],
                    ['label' => 'Clients', 'url' => '/agency/crm/clients', 'sort_order' => 2],
                    ['label' => 'Follow-ups', 'url' => '/agency/crm/follow-ups', 'sort_order' => 3],
                    ['label' => 'Tasks', 'url' => '/agency/crm/tasks', 'sort_order' => 4],
                    ['label' => 'Appointments', 'url' => '/agency/crm/appointments', 'sort_order' => 5],
                    ['label' => 'Communication Logs', 'url' => '/agency/crm/communication-logs', 'sort_order' => 6],
                ],
            ],
            [
                'label' => 'Properties & Estates',
                'url' => '/agency/properties',
                'icon' => 'building',
                'sort_order' => 4,
                'children' => [
                    // Properties submenu
                    [
                        'label' => 'Properties',
                        'url' => '/agency/properties/all',
                        'sort_order' => 1,
                        'children' => [
                            ['label' => 'All Properties', 'url' => '/agency/properties/all', 'sort_order' => 1],
                            ['label' => 'Add New Property', 'url' => '/agency/properties/create', 'sort_order' => 2],
                            ['label' => 'Categories', 'url' => '/agency/properties/categories', 'sort_order' => 3],
                            ['label' => 'Property Status', 'url' => '/agency/properties/status', 'sort_order' => 4],
                        ],
                    ],
                    // Estates / Projects submenu
                    [
                        'label' => 'Estates / Projects',
                        'url' => '/agency/estates',
                        'sort_order' => 2,
                        'children' => [
                            ['label' => 'All Estates / Developments', 'url' => '/agency/estates/all', 'sort_order' => 1],
                            ['label' => 'Add New Estate', 'url' => '/agency/estates/create', 'sort_order' => 2],
                            ['label' => 'Phases', 'url' => '/agency/estates/phases', 'sort_order' => 3],
                            ['label' => 'Plot/Unit Inventory', 'url' => '/agency/estates/inventory', 'sort_order' => 4],
                            ['label' => 'Estate Map / Site Plan', 'url' => '/agency/estates/site-plan', 'sort_order' => 5],
                            ['label' => 'Plot Allocation', 'url' => '/agency/estates/plot-allocation', 'sort_order' => 6],
                            ['label' => 'Reservation Management', 'url' => '/agency/estates/reservations', 'sort_order' => 7],
                        ],
                    ],
                    // Units/Plots submenu
                    [
                        'label' => 'Units/Plots',
                        'url' => '/agency/units',
                        'sort_order' => 3,
                        'children' => [
                            ['label' => 'All Plots/Units', 'url' => '/agency/units/all', 'sort_order' => 1],
                            ['label' => 'Available Units', 'url' => '/agency/units/available', 'sort_order' => 2],
                            ['label' => 'Reserved Units', 'url' => '/agency/units/reserved', 'sort_order' => 3],
                            ['label' => 'Sold/Allocated Units', 'url' => '/agency/units/sold', 'sort_order' => 4],
                        ],
                    ],
                ],
            ],
            [
                'label' => 'Sales & Deals',
                'url' => '/agency/sales',
                'icon' => 'dollar-sign',
                'sort_order' => 5,
                'children' => [
                    ['label' => 'Transactions', 'url' => '/agency/sales/transactions', 'sort_order' => 1],
                    ['label' => 'Offers & Negotiations', 'url' => '/agency/sales/offers', 'sort_order' => 2],
                    ['label' => 'Allocations', 'url' => '/agency/sales/allocations', 'sort_order' => 3],
                    ['label' => 'Reservations', 'url' => '/agency/sales/reservations', 'sort_order' => 4],
                    ['label' => 'Installment Plans', 'url' => '/agency/sales/installment-plans', 'sort_order' => 5],
                    ['label' => 'Commission Breakdown', 'url' => '/agency/sales/commissions', 'sort_order' => 6],
                    ['label' => 'Closing Reports', 'url' => '/agency/sales/closing-reports', 'sort_order' => 7],
                ],
            ],
            [
                'label' => 'Documents & Files',
                'url' => '/agency/documents',
                'icon' => 'file-text',
                'sort_order' => 6,
                'children' => [
                    ['label' => 'Document Manager', 'url' => '/agency/documents/manager', 'sort_order' => 1],
                    ['label' => 'Contracts & Agreements', 'url' => '/agency/documents/contracts', 'sort_order' => 2],
                    ['label' => 'Title Documents', 'url' => '/agency/documents/titles', 'sort_order' => 3],
                    ['label' => 'Uploaded Client Files', 'url' => '/agency/documents/client-files', 'sort_order' => 4],
                    ['label' => 'Estate Documents', 'url' => '/agency/documents/estate-docs', 'sort_order' => 5],
                    ['label' => 'E-signature Workflows', 'url' => '/agency/documents/e-signature', 'sort_order' => 6],
                    ['label' => 'Templates Library', 'url' => '/agency/documents/templates', 'sort_order' => 7],
                ],
            ],
            [
                'label' => 'Billing & Finance',
                'url' => '/agency/finance',
                'icon' => 'credit-card',
                'sort_order' => 7,
                'children' => [
                    ['label' => 'Invoices', 'url' => '/agency/finance/invoices', 'sort_order' => 1],
                    ['label' => 'Receipts', 'url' => '/agency/finance/receipts', 'sort_order' => 2],
                    ['label' => 'Payment Schedules', 'url' => '/agency/finance/payment-schedules', 'sort_order' => 3],
                    ['label' => 'Payment Tracking', 'url' => '/agency/finance/payment-tracking', 'sort_order' => 4],
                    ['label' => 'Payouts (Realtor Commissions)', 'url' => '/agency/finance/payouts', 'sort_order' => 5],
                    ['label' => 'Financial Reports', 'url' => '/agency/finance/reports', 'sort_order' => 6],
                ],
            ],
            [
                'label' => 'Marketing',
                'url' => '/agency/marketing',
                'icon' => 'megaphone',
                'sort_order' => 8,
                'children' => [
                    ['label' => 'Website Builder', 'url' => '/agency/marketing/website-builder', 'sort_order' => 1],
                    ['label' => 'Property Listings Manager', 'url' => '/agency/marketing/listings', 'sort_order' => 2],
                    ['label' => 'Auto-Flyer Generator', 'url' => '/agency/marketing/flyer-generator', 'sort_order' => 3],
                    ['label' => 'Video/Photo Storage', 'url' => '/agency/marketing/media-storage', 'sort_order' => 4],
                    ['label' => 'Leads Capture Forms', 'url' => '/agency/marketing/lead-forms', 'sort_order' => 5],
                    ['label' => 'Landing Pages', 'url' => '/agency/marketing/landing-pages', 'sort_order' => 6],
                ],
            ],
            [
                'label' => 'Automation & Integrations',
                'url' => '/agency/automation',
                'icon' => 'smartphone',
                'sort_order' => 9,
                'children' => [
                    ['label' => 'WhatsApp Automation', 'url' => '/agency/automation/whatsapp', 'sort_order' => 1],
                    ['label' => 'Email & SMS Templates', 'url' => '/agency/automation/templates', 'sort_order' => 2],
                    ['label' => 'Webhooks', 'url' => '/agency/automation/webhooks', 'sort_order' => 3],
                    ['label' => 'API Keys', 'url' => '/agency/automation/api-keys', 'sort_order' => 4],
                    ['label' => 'Zapier (optional)', 'url' => '/agency/automation/zapier', 'sort_order' => 5],
                ],
            ],
            [
                'label' => 'Reports & Analytics',
                'url' => '/agency/reports',
                'icon' => 'bar-chart',
                'sort_order' => 10,
                'children' => [
                    ['label' => 'Agent Performance', 'url' => '/agency/reports/agent-performance', 'sort_order' => 1],
                    ['label' => 'Sales Reports', 'url' => '/agency/reports/sales', 'sort_order' => 2],
                    ['label' => 'Revenue Analytics', 'url' => '/agency/reports/revenue', 'sort_order' => 3],
                    ['label' => 'Estate/Plot Sales Analytics', 'url' => '/agency/reports/estate-sales', 'sort_order' => 4],
                    ['label' => 'Marketing Analytics', 'url' => '/agency/reports/marketing', 'sort_order' => 5],
                    ['label' => 'Lead Conversion Funnel', 'url' => '/agency/reports/conversion-funnel', 'sort_order' => 6],
                ],
            ],
            [
                'label' => 'Settings',
                'url' => '/agency/settings',
                'icon' => 'settings',
                'sort_order' => 11,
                'children' => [
                    ['label' => 'Agency Profile', 'url' => '/agency/settings/profile', 'sort_order' => 1],
                    ['label' => 'Branding & Theme', 'url' => '/agency/settings/branding', 'sort_order' => 2],
                    ['label' => 'Subscription Plan', 'url' => '/agency/settings/subscription', 'sort_order' => 3],
                    ['label' => 'User Management', 'url' => '/agency/settings/users', 'sort_order' => 4],
                    ['label' => 'Payment Settings (Paystack/Stripe)', 'url' => '/agency/settings/payment-settings', 'sort_order' => 5],
                    ['label' => 'Security (2FA, Sessions)', 'url' => '/agency/settings/security', 'sort_order' => 6],
                    ['label' => 'Audit Logs', 'url' => '/agency/settings/audit-logs', 'sort_order' => 7],
                    ['label' => 'Notifications Settings', 'url' => '/agency/settings/notifications', 'sort_order' => 8],
                ],
            ],
        ];
    }

    /**
     * Create menu items recursively.
     */
    private function createMenuItems(int $menuId, array $items, ?int $parentId = null): void
    {
        foreach ($items as $item) {
            $children = $item['children'] ?? [];
            unset($item['children']);

            $menuItem = MenuItem::create([
                'menu_id' => $menuId,
                'parent_id' => $parentId,
                'label' => $item['label'],
                'url' => $item['url'],
                'icon' => $item['icon'] ?? null,
                'sort_order' => $item['sort_order'],
                'open_new_tab' => $item['open_new_tab'] ?? false,
            ]);

            // Recursively create children
            if (!empty($children)) {
                $this->createMenuItems($menuId, $children, $menuItem->id);
            }
        }
    }
}
