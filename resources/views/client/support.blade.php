@extends('layouts.dashboard')

@section('page-title', 'Contact Support')

@section('page-content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Send us a message</h3>
            <form class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                    <input type="text" placeholder="What can we help you with?" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option>Select a category</option>
                        <option>Property Question</option>
                        <option>Payment Issue</option>
                        <option>Document Request</option>
                        <option>Technical Support</option>
                        <option>Other</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Property (Optional)</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option>Select a property</option>
                        <option>Modern Apartment - 123 Main St</option>
                        <option>Downtown Condo - 456 Oak Ave</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                    <textarea rows="6" placeholder="Describe your issue or question..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Attachments (Optional)</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 transition cursor-pointer">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        <p class="text-sm text-gray-600">Click to upload or drag and drop</p>
                        <p class="text-xs text-gray-500 mt-1">PNG, JPG, PDF up to 10MB</p>
                    </div>
                </div>

                <button type="submit" class="w-full px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold">
                    Send Message
                </button>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow p-6 mt-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Tickets</h3>
            <div class="space-y-3">
                <div class="flex items-start justify-between p-4 border border-gray-200 rounded-lg hover:border-blue-500 transition">
                    <div>
                        <p class="font-medium text-gray-900">Payment Issue - November</p>
                        <p class="text-sm text-gray-600 mt-1">I have a question about my recent payment...</p>
                        <p class="text-xs text-gray-500 mt-2">Submitted 2 days ago</p>
                    </div>
                    <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">In Progress</span>
                </div>

                <div class="flex items-start justify-between p-4 border border-gray-200 rounded-lg">
                    <div>
                        <p class="font-medium text-gray-900">Document Request</p>
                        <p class="text-sm text-gray-600 mt-1">Can you send me a copy of my title deed?</p>
                        <p class="text-xs text-gray-500 mt-2">Submitted 5 days ago</p>
                    </div>
                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Resolved</span>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h3>
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">Email</p>
                        <p class="text-sm text-gray-600">support@agency.com</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">Phone</p>
                        <p class="text-sm text-gray-600">+1 (555) 123-4567</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">Office Hours</p>
                        <p class="text-sm text-gray-600">Mon-Fri: 9am - 6pm</p>
                        <p class="text-sm text-gray-600">Sat-Sun: Closed</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-blue-900 mb-2">Need Immediate Help?</h3>
            <p class="text-sm text-blue-700 mb-4">For urgent matters, please call our 24/7 emergency line:</p>
            <a href="tel:+15551234567" class="block w-full px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold text-center">
                +1 (555) 123-4567
            </a>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Frequently Asked Questions</h3>
            <div class="space-y-3">
                <a href="#" class="block text-sm text-blue-600 hover:text-blue-800">How do I make a payment?</a>
                <a href="#" class="block text-sm text-blue-600 hover:text-blue-800">Where can I find my documents?</a>
                <a href="#" class="block text-sm text-blue-600 hover:text-blue-800">How do I update my contact information?</a>
                <a href="#" class="block text-sm text-blue-600 hover:text-blue-800">What if I have a maintenance issue?</a>
            </div>
        </div>
    </div>
</div>
@endsection
