@php
$role = auth()->user()->role;

$navigation = [
    'super_admin' => [
        ['name' => 'Dashboard', 'route' => 'saas.dashboard', 'icon' => 'dashboard'],
        ['name' => 'Agencies', 'route' => 'saas.agencies.index', 'icon' => 'building'],
        ['name' => 'Subscription Plans', 'route' => 'saas.plans.index', 'icon' => 'credit-card'],
        ['name' => 'Themes', 'route' => 'saas.themes.index', 'icon' => 'palette'],
        ['name' => 'Settings', 'route' => 'saas.settings', 'icon' => 'settings'],
    ],
    'agency_admin' => [
        ['name' => 'Dashboard', 'route' => 'agency.dashboard', 'icon' => 'dashboard'],
        ['name' => 'CRM', 'icon' => 'users', 'children' => [
            ['name' => 'Leads', 'route' => 'agency.leads.index'],
            ['name' => 'Clients', 'route' => 'agency.clients.index'],
        ]],
        ['name' => 'Properties', 'route' => 'agency.properties.index', 'icon' => 'home'],
        ['name' => 'Transactions', 'route' => 'agency.transactions.index', 'icon' => 'dollar'],
        ['name' => 'Team', 'icon' => 'user-cog', 'children' => [
            ['name' => 'Realtors', 'route' => 'agency.realtors.index'],
            ['name' => 'Branches', 'route' => 'agency.branches.index'],
        ]],
        ['name' => 'Documents', 'route' => 'agency.documents.index', 'icon' => 'file-text'],
        ['name' => 'Website', 'route' => 'agency.website.index', 'icon' => 'globe'],
        ['name' => 'Payments', 'route' => 'agency.payments.index', 'icon' => 'credit-card'],
        ['name' => 'Reports', 'route' => 'agency.reports.index', 'icon' => 'bar-chart'],
        ['name' => 'Settings', 'route' => 'agency.settings', 'icon' => 'settings'],
    ],
    'realtor' => [
        ['name' => 'Dashboard', 'route' => 'realtor.dashboard', 'icon' => 'dashboard'],
        ['name' => 'My Leads', 'route' => 'realtor.leads.index', 'icon' => 'user-plus'],
        ['name' => 'My Clients', 'route' => 'realtor.clients.index', 'icon' => 'users'],
        ['name' => 'My Properties', 'route' => 'realtor.properties.index', 'icon' => 'home'],
        ['name' => 'Commissions', 'route' => 'realtor.commissions.index', 'icon' => 'dollar'],
        ['name' => 'Documents', 'route' => 'realtor.documents.index', 'icon' => 'file-text'],
    ],
    'client' => [
        ['name' => 'Dashboard', 'route' => 'client.dashboard', 'icon' => 'dashboard'],
        ['name' => 'My Properties', 'route' => 'client.properties.index', 'icon' => 'home'],
        ['name' => 'Documents', 'route' => 'client.documents.index', 'icon' => 'file-text'],
        ['name' => 'Payments', 'route' => 'client.payments.index', 'icon' => 'credit-card'],
        ['name' => 'Support', 'route' => 'client.support', 'icon' => 'message'],
    ],
];

$items = $navigation[$role] ?? [];
@endphp

<ul class="space-y-1 px-2">
    @foreach($items as $item)
        @if(isset($item['children']))
            <li x-data="{ open: {{ request()->routeIs(collect($item['children'])->pluck('route')->map(fn($r) => $r.'*')->implode(',')) ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg transition">
                    <span class="flex items-center space-x-3">
                        @include('components.icon', ['name' => $item['icon'], 'class' => 'w-5 h-5'])
                        <span>{{ $item['name'] }}</span>
                    </span>
                    <svg class="w-4 h-4 transform transition" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <ul x-show="open" x-cloak class="mt-1 space-y-1 pl-11">
                    @foreach($item['children'] as $child)
                        <li>
                            <a href="{{ route($child['route']) }}"
                               class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 rounded-lg {{ request()->routeIs($child['route'].'*') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                                {{ $child['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @else
            <li>
                <a href="{{ route($item['route']) }}"
                   class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-lg transition {{ request()->routeIs($item['route'].'*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50' }}">
                    @include('components.icon', ['name' => $item['icon'], 'class' => 'w-5 h-5'])
                    <span>{{ $item['name'] }}</span>
                </a>
            </li>
        @endif
    @endforeach
</ul>
