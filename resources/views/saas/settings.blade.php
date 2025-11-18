@extends('layouts.dashboard')

@section('page-title', 'Global Settings')

@section('page-content')
<div x-data="{ tab: 'general' }" class="flex flex-col lg:flex-row gap-6">
    <!-- Sidebar Tabs -->
    <div class="lg:w-64 flex-shrink-0">
        <div class="bg-white rounded-lg shadow p-4">
            <nav class="space-y-1">
                <button @click="tab = 'general'" :class="tab === 'general' ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50'" class="w-full flex items-center px-3 py-2 text-sm font-medium rounded-lg">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    General
                </button>
                <button @click="tab = 'email'" :class="tab === 'email' ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50'" class="w-full flex items-center px-3 py-2 text-sm font-medium rounded-lg">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Email Settings
                </button>
                <button @click="tab = 'payment'" :class="tab === 'payment' ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50'" class="w-full flex items-center px-3 py-2 text-sm font-medium rounded-lg">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                    Payment Gateway
                </button>
                <button @click="tab = 'security'" :class="tab === 'security' ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50'" class="w-full flex items-center px-3 py-2 text-sm font-medium rounded-lg">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    Security
                </button>
                <button @click="tab = 'api'" :class="tab === 'api' ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50'" class="w-full flex items-center px-3 py-2 text-sm font-medium rounded-lg">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                    API Keys
                </button>
                <button @click="tab = 'backup'" :class="tab === 'backup' ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-50'" class="w-full flex items-center px-3 py-2 text-sm font-medium rounded-lg">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Backup & Restore
                </button>
            </nav>
        </div>
    </div>

    <!-- Content Area -->
    <div class="flex-1">
        <!-- General Settings -->
        <div x-show="tab === 'general'" class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">General Settings</h3>
            </div>
            <form class="p-6 space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Platform Name</label>
                    <input type="text" value="RealEstate SaaS" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Support Email</label>
                    <input type="email" value="support@realestate-saas.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Timezone</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option>UTC</option>
                        <option selected>America/New_York</option>
                        <option>Europe/London</option>
                        <option>Asia/Tokyo</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date Format</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option>MM/DD/YYYY</option>
                        <option selected>DD/MM/YYYY</option>
                        <option>YYYY-MM-DD</option>
                    </select>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" id="maintenance" checked class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="maintenance" class="ml-2 text-sm text-gray-700">Enable New Agency Registrations</label>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save Changes</button>
                </div>
            </form>
        </div>

        <!-- Email Settings -->
        <div x-show="tab === 'email'" x-cloak class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Email Configuration</h3>
            </div>
            <form class="p-6 space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">SMTP Host</label>
                    <input type="text" placeholder="smtp.gmail.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">SMTP Port</label>
                        <input type="text" value="587" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Encryption</label>
                        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option>None</option>
                            <option selected>TLS</option>
                            <option>SSL</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                    <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" class="px-4 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50">Test Connection</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save Changes</button>
                </div>
            </form>
        </div>

        <!-- Payment Gateway -->
        <div x-show="tab === 'payment'" x-cloak class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Payment Gateway Settings</h3>
            </div>
            <div class="p-6 space-y-6">
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <span class="text-blue-600 font-bold">S</span>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-sm font-semibold text-gray-900">Stripe</h4>
                                <p class="text-xs text-gray-500">Accept cards and digital wallets</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                    <div class="space-y-3">
                        <input type="text" placeholder="Publishable Key" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <input type="password" placeholder="Secret Key" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>
                </div>

                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <span class="text-purple-600 font-bold">P</span>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-sm font-semibold text-gray-900">PayPal</h4>
                                <p class="text-xs text-gray-500">Accept PayPal payments</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                    <div class="space-y-3">
                        <input type="text" placeholder="Client ID" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <input type="password" placeholder="Client Secret" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save Changes</button>
                </div>
            </div>
        </div>

        <!-- Security -->
        <div x-show="tab === 'security'" x-cloak class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Security Settings</h3>
            </div>
            <form class="p-6 space-y-6">
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                    <div>
                        <p class="text-sm font-medium text-gray-900">Two-Factor Authentication</p>
                        <p class="text-xs text-gray-500">Require 2FA for all admin accounts</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" checked class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                    <div>
                        <p class="text-sm font-medium text-gray-900">Session Timeout</p>
                        <p class="text-xs text-gray-500">Auto logout after inactivity</p>
                    </div>
                    <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option>15 minutes</option>
                        <option selected>30 minutes</option>
                        <option>1 hour</option>
                        <option>Never</option>
                    </select>
                </div>
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                    <div>
                        <p class="text-sm font-medium text-gray-900">Password Complexity</p>
                        <p class="text-xs text-gray-500">Enforce strong passwords</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" checked class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save Changes</button>
                </div>
            </form>
        </div>

        <!-- API Keys -->
        <div x-show="tab === 'api'" x-cloak class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">API Keys</h3>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">Generate New Key</button>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-900">Production API Key</span>
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Active</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <code class="flex-1 px-3 py-2 bg-gray-50 rounded border border-gray-200 text-sm font-mono">sk_live_••••••••••••••••••••1234</code>
                            <button class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-sm">Copy</button>
                            <button class="px-3 py-2 border border-red-300 text-red-600 rounded-lg hover:bg-red-50 text-sm">Revoke</button>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Created on Nov 15, 2025 • Last used 2 hours ago</p>
                    </div>
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-900">Test API Key</span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">Test</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <code class="flex-1 px-3 py-2 bg-gray-50 rounded border border-gray-200 text-sm font-mono">sk_test_••••••••••••••••••••5678</code>
                            <button class="px-3 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-sm">Copy</button>
                            <button class="px-3 py-2 border border-red-300 text-red-600 rounded-lg hover:bg-red-50 text-sm">Revoke</button>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Created on Nov 10, 2025 • Last used 1 day ago</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Backup & Restore -->
        <div x-show="tab === 'backup'" x-cloak class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Backup & Restore</h3>
            </div>
            <div class="p-6 space-y-6">
                <div class="flex items-center justify-between p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <div>
                        <p class="text-sm font-medium text-blue-900">Automatic Backups</p>
                        <p class="text-xs text-blue-700">Daily backups at 2:00 AM UTC</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" checked class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>
                <button class="w-full px-4 py-3 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition">
                    <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                    </svg>
                    <p class="text-sm font-medium text-gray-700">Create Manual Backup Now</p>
                </button>
                <div>
                    <h4 class="text-sm font-semibold text-gray-900 mb-3">Recent Backups</h4>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"></path>
                                </svg>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">backup-2025-11-18.zip</p>
                                    <p class="text-xs text-gray-500">248 MB • Nov 18, 2025 at 2:00 AM</p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button class="px-3 py-1.5 border border-gray-300 rounded hover:bg-gray-50 text-sm">Download</button>
                                <button class="px-3 py-1.5 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Restore</button>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"></path>
                                </svg>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">backup-2025-11-17.zip</p>
                                    <p class="text-xs text-gray-500">246 MB • Nov 17, 2025 at 2:00 AM</p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button class="px-3 py-1.5 border border-gray-300 rounded hover:bg-gray-50 text-sm">Download</button>
                                <button class="px-3 py-1.5 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Restore</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
