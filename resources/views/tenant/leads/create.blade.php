@extends('layouts.app')

@section('title', 'Add New Lead')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">
            <i class="fas fa-user-plus mr-2 text-indigo-600"></i>
            Add New Lead
        </h1>
        <p class="mt-1 text-sm text-gray-600">
            Capture lead information to start the sales process
        </p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow">
        <form action="{{ route('tenant.leads.store') }}" method="POST">
            @csrf

            <div class="p-6 space-y-6">
                <!-- Personal Information -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-user mr-2 text-gray-600"></i>
                        Personal Information
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Full Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                                   placeholder="John Doe">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                Email Address
                            </label>
                            <input type="email" name="email" id="email"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                                   placeholder="john@example.com">
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                                Phone Number <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="phone" id="phone" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                                   placeholder="+1234567890">
                        </div>

                        <!-- Source -->
                        <div>
                            <label for="source" class="block text-sm font-medium text-gray-700 mb-1">
                                Lead Source <span class="text-red-500">*</span>
                            </label>
                            <select name="source" id="source" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Select Source</option>
                                <option value="website">Website</option>
                                <option value="referral">Referral</option>
                                <option value="walk_in">Walk-in</option>
                                <option value="phone_call">Phone Call</option>
                                <option value="social_media">Social Media</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Lead Classification -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-tag mr-2 text-gray-600"></i>
                        Lead Classification
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                Status
                            </label>
                            <select name="status" id="status"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="new" selected>New</option>
                                <option value="contacted">Contacted</option>
                                <option value="qualified">Qualified</option>
                                <option value="proposal">Proposal</option>
                                <option value="negotiation">Negotiation</option>
                                <option value="won">Won</option>
                                <option value="lost">Lost</option>
                            </select>
                        </div>

                        <!-- Priority -->
                        <div>
                            <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">
                                Priority
                            </label>
                            <select name="priority" id="priority"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="low">Low</option>
                                <option value="medium" selected>Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>

                        <!-- Assign To -->
                        <div>
                            <label for="assigned_to" class="block text-sm font-medium text-gray-700 mb-1">
                                Assign To Realtor
                            </label>
                            <select name="assigned_to" id="assigned_to"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Unassigned</option>
                                @foreach($realtors ?? [] as $realtor)
                                    <option value="{{ $realtor->id }}">{{ $realtor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Property Preferences -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-home mr-2 text-gray-600"></i>
                        Property Preferences
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Budget -->
                        <div>
                            <label for="budget" class="block text-sm font-medium text-gray-700 mb-1">
                                Budget (USD)
                            </label>
                            <input type="number" name="budget" id="budget"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                                   placeholder="250000">
                        </div>

                        <!-- Location Preference -->
                        <div>
                            <label for="location_preference" class="block text-sm font-medium text-gray-700 mb-1">
                                Preferred Location
                            </label>
                            <input type="text" name="location_preference" id="location_preference"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                                   placeholder="Beverly Hills, CA">
                        </div>

                        <!-- Property Type -->
                        <div>
                            <label for="property_type_preference" class="block text-sm font-medium text-gray-700 mb-1">
                                Property Type
                            </label>
                            <select name="property_type_preference" id="property_type_preference"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Any</option>
                                <option value="land">Land</option>
                                <option value="house">House</option>
                                <option value="apartment">Apartment</option>
                                <option value="commercial">Commercial</option>
                                <option value="shortlet">Shortlet</option>
                                <option value="estate">Estate</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-sticky-note mr-2 text-gray-600"></i>
                        Additional Information
                    </h2>
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                            Notes
                        </label>
                        <textarea name="notes" id="notes" rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                                  placeholder="Add any additional notes about this lead..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center rounded-b-lg">
                <a href="{{ route('tenant.leads.index') }}" class="text-gray-600 hover:text-gray-800 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Leads
                </a>
                <div class="flex space-x-3">
                    <button type="button" onclick="window.location.href='{{ route('tenant.leads.index') }}'"
                            class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Save Lead
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
