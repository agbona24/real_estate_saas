@extends('layouts.dashboard')

@section('page-title', 'Agency Settings')

@section('page-content')
<div x-data="{ tab: 'general' }" class="flex flex-col lg:flex-row gap-6">
    <div class="lg:w-64">
        <div class="bg-white rounded-lg shadow p-4">
            <nav class="space-y-1">
                <button @click="tab = 'general'" :class="tab === 'general' ? 'bg-blue-50 text-blue-600' : 'text-gray-700'" class="w-full text-left px-3 py-2 text-sm font-medium rounded-lg hover:bg-gray-50">General</button>
                <button @click="tab = 'branding'" :class="tab === 'branding' ? 'bg-blue-50 text-blue-600' : 'text-gray-700'" class="w-full text-left px-3 py-2 text-sm font-medium rounded-lg hover:bg-gray-50">Branding</button>
                <button @click="tab = 'notifications'" :class="tab === 'notifications' ? 'bg-blue-50 text-blue-600' : 'text-gray-700'" class="w-full text-left px-3 py-2 text-sm font-medium rounded-lg hover:bg-gray-50">Notifications</button>
                <button @click="tab = 'billing'" :class="tab === 'billing' ? 'bg-blue-50 text-blue-600' : 'text-gray-700'" class="w-full text-left px-3 py-2 text-sm font-medium rounded-lg hover:bg-gray-50">Billing</button>
            </nav>
        </div>
    </div>

    <div class="flex-1">
        <div x-show="tab === 'general'" class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">General Settings</h3>
            <form class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Agency Name</label>
                    <input type="text" value="Prime Realty" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" value="contact@primerealty.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                    <input type="tel" value="+1 (555) 123-4567" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <textarea rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">123 Main Street, Downtown, NY 10001</textarea>
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save Changes</button>
            </form>
        </div>

        <div x-show="tab === 'branding'" x-cloak class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Branding</h3>
            <form class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Logo</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-sm text-gray-600">Click to upload or drag and drop</p>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Brand Color</label>
                    <input type="color" value="#3B82F6" class="w-20 h-10 border border-gray-300 rounded">
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save Changes</button>
            </form>
        </div>

        <div x-show="tab === 'notifications'" x-cloak class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Notification Preferences</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 border rounded-lg">
                    <div>
                        <p class="font-medium text-gray-900">New Lead Notifications</p>
                        <p class="text-sm text-gray-500">Receive emails when new leads are created</p>
                    </div>
                    <input type="checkbox" checked class="w-4 h-4 text-blue-600 rounded">
                </div>
                <div class="flex items-center justify-between p-4 border rounded-lg">
                    <div>
                        <p class="font-medium text-gray-900">Transaction Updates</p>
                        <p class="text-sm text-gray-500">Get notified about transaction status changes</p>
                    </div>
                    <input type="checkbox" checked class="w-4 h-4 text-blue-600 rounded">
                </div>
                <div class="flex items-center justify-between p-4 border rounded-lg">
                    <div>
                        <p class="font-medium text-gray-900">Weekly Reports</p>
                        <p class="text-sm text-gray-500">Receive weekly performance reports</p>
                    </div>
                    <input type="checkbox" class="w-4 h-4 text-blue-600 rounded">
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save Changes</button>
            </div>
        </div>

        <div x-show="tab === 'billing'" x-cloak class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Billing Information</h3>
            <div class="space-y-6">
                <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-semibold text-blue-900">Professional Plan</p>
                            <p class="text-sm text-blue-700">$299/month</p>
                        </div>
                        <button class="text-sm text-blue-600 hover:text-blue-800">Change Plan</button>
                    </div>
                </div>
                <div>
                    <h4 class="font-medium text-gray-900 mb-3">Payment Method</h4>
                    <div class="flex items-center justify-between p-4 border rounded-lg">
                        <div class="flex items-center">
                            <div class="w-12 h-8 bg-gray-200 rounded mr-3"></div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">•••• •••• •••• 4242</p>
                                <p class="text-xs text-gray-500">Expires 12/2026</p>
                            </div>
                        </div>
                        <button class="text-sm text-blue-600 hover:text-blue-800">Update</button>
                    </div>
                </div>
                <button class="text-red-600 hover:text-red-800 text-sm font-medium">Cancel Subscription</button>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
