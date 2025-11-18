@extends('layouts.app')

@section('title', 'My Documents')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                <i class="fas fa-folder-open mr-2 text-indigo-600"></i>
                My Documents
            </h1>
            <p class="mt-1 text-sm text-gray-600">
                Access all your property documents, contracts, and receipts
            </p>
        </div>
        <div class="flex space-x-3">
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-md">
                <i class="fas fa-download mr-2"></i>
                Download All
            </button>
        </div>
    </div>

    <!-- Pending Actions Alert -->
    @if(($pending_signatures ?? 0) > 0)
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg">
            <div class="flex items-start">
                <i class="fas fa-exclamation-triangle text-yellow-600 text-xl mt-0.5 mr-3"></i>
                <div class="flex-1">
                    <h3 class="text-sm font-medium text-yellow-900">Action Required</h3>
                    <p class="text-sm text-yellow-700 mt-1">
                        You have <strong>{{ $pending_signatures }}</strong> document(s) awaiting your signature.
                    </p>
                    <a href="#" class="text-sm font-medium text-yellow-800 hover:text-yellow-900 mt-2 inline-block">
                        View pending documents <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- Quick Stats -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] ?? 24 }}</p>
            <p class="text-xs text-gray-600">Total Documents</p>
        </div>
        <div class="bg-blue-50 rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-blue-900">{{ $stats['contracts'] ?? 8 }}</p>
            <p class="text-xs text-blue-600">Contracts</p>
        </div>
        <div class="bg-green-50 rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-green-900">{{ $stats['receipts'] ?? 12 }}</p>
            <p class="text-xs text-green-600">Receipts</p>
        </div>
        <div class="bg-purple-50 rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-purple-900">{{ $stats['titles'] ?? 3 }}</p>
            <p class="text-xs text-purple-600">Title Docs</p>
        </div>
        <div class="bg-yellow-50 rounded-lg shadow p-4 text-center">
            <p class="text-2xl font-bold text-yellow-900">{{ $stats['pending'] ?? 2 }}</p>
            <p class="text-xs text-yellow-600">Pending Signature</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Left Sidebar - Filters -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow p-6 sticky top-6">
                <h3 class="font-semibold text-gray-900 mb-4">Filter Documents</h3>

                <!-- Property Filter -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">By Property</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                        <option>All Properties</option>
                        @foreach($properties ?? [] as $property)
                            <option value="{{ $property->id }}">{{ $property->title }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Category Filter -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">By Category</label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Offer Letters ({{ $counts['offers'] ?? 2 }})</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Contracts ({{ $counts['contracts'] ?? 8 }})</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Allocation Letters ({{ $counts['allocation'] ?? 2 }})</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Receipts ({{ $counts['receipts'] ?? 12 }})</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Title Documents ({{ $counts['titles'] ?? 3 }})</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="h-4 w-4 text-indigo-600 rounded" checked>
                            <span class="ml-2 text-sm text-gray-700">Other ({{ $counts['other'] ?? 1 }})</span>
                        </label>
                    </div>
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">By Status</label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="radio" name="status" class="h-4 w-4 text-indigo-600" checked>
                            <span class="ml-2 text-sm text-gray-700">All Documents</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="status" class="h-4 w-4 text-indigo-600">
                            <span class="ml-2 text-sm text-gray-700">Pending Signature</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="status" class="h-4 w-4 text-indigo-600">
                            <span class="ml-2 text-sm text-gray-700">Signed</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="lg:col-span-3">
            <!-- Search Bar -->
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    <input type="text" placeholder="Search documents by name, category, or property..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>

            <!-- Documents by Property -->
            @foreach($documents_by_property ?? [] as $property_name => $docs)
                <div class="bg-white rounded-lg shadow mb-6">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-home text-indigo-600 text-xl"></i>
                                <div>
                                    <h2 class="font-semibold text-gray-900">{{ $property_name ?? '4 Bedroom Luxury Villa' }}</h2>
                                    <p class="text-xs text-gray-600">{{ count($docs) }} documents</p>
                                </div>
                            </div>
                            <button class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                                <i class="fas fa-download mr-1"></i> Download All
                            </button>
                        </div>
                    </div>

                    <!-- Documents List -->
                    <div class="divide-y divide-gray-200">
                        @foreach($docs as $document)
                            <div class="p-4 hover:bg-gray-50 transition">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4 flex-1">
                                        <!-- File Icon -->
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 rounded-lg flex items-center justify-center
                                                {{ ($document->type ?? 'pdf') === 'pdf' ? 'bg-red-100' : '' }}
                                                {{ ($document->type ?? '') === 'doc' ? 'bg-blue-100' : '' }}
                                                {{ ($document->type ?? '') === 'img' ? 'bg-green-100' : '' }}">
                                                <i class="fas fa-file-{{ ($document->type ?? 'pdf') === 'pdf' ? 'pdf' : (($document->type ?? '') === 'doc' ? 'word' : 'image') }} text-2xl
                                                    {{ ($document->type ?? 'pdf') === 'pdf' ? 'text-red-600' : '' }}
                                                    {{ ($document->type ?? '') === 'doc' ? 'text-blue-600' : '' }}
                                                    {{ ($document->type ?? '') === 'img' ? 'text-green-600' : '' }}"></i>
                                            </div>
                                        </div>

                                        <!-- Document Info -->
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center space-x-2 mb-1">
                                                <h3 class="text-sm font-medium text-gray-900 truncate">{{ $document->name ?? 'Purchase Agreement.pdf' }}</h3>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                                    {{ ($document->category ?? 'contract') === 'offer' ? 'bg-blue-100 text-blue-800' : '' }}
                                                    {{ ($document->category ?? '') === 'contract' ? 'bg-purple-100 text-purple-800' : '' }}
                                                    {{ ($document->category ?? '') === 'allocation' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                    {{ ($document->category ?? '') === 'receipt' ? 'bg-green-100 text-green-800' : '' }}
                                                    {{ ($document->category ?? '') === 'title' ? 'bg-indigo-100 text-indigo-800' : '' }}">
                                                    {{ ucfirst($document->category ?? 'contract') }}
                                                </span>

                                                @if($document->requires_signature ?? false)
                                                    @if($document->signed ?? false)
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                                            <i class="fas fa-check-circle mr-1"></i> Signed
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800 animate-pulse">
                                                            <i class="fas fa-pen mr-1"></i> Signature Required
                                                        </span>
                                                    @endif
                                                @endif
                                            </div>

                                            <div class="flex items-center space-x-4 text-xs text-gray-500">
                                                <span><i class="fas fa-calendar mr-1"></i> Uploaded {{ $document->uploaded_at ?? 'Nov 10, 2025' }}</span>
                                                <span><i class="fas fa-file mr-1"></i> {{ $document->size ?? '2.4 MB' }}</span>
                                                @if($document->signed_at ?? null)
                                                    <span class="text-green-600"><i class="fas fa-signature mr-1"></i> Signed {{ $document->signed_at }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex items-center space-x-2 ml-4">
                                        <button onclick="window.location.href='{{ route('documents.preview', $document->id ?? 1) }}'" class="text-indigo-600 hover:text-indigo-700 px-3 py-2 text-sm rounded hover:bg-indigo-50" title="Preview">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-blue-600 hover:text-blue-700 px-3 py-2 text-sm rounded hover:bg-blue-50" title="Download">
                                            <i class="fas fa-download"></i>
                                        </button>
                                        @if(!($document->signed ?? false) && ($document->requires_signature ?? false))
                                            <button onclick="window.location.href='{{ route('documents.sign', $document->id ?? 1) }}'" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded text-sm font-medium">
                                                <i class="fas fa-pen mr-1"></i> Sign Now
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <!-- Empty State -->
            @if(empty($documents_by_property))
                <div class="bg-white rounded-lg shadow p-12 text-center">
                    <i class="fas fa-folder-open text-gray-300 text-6xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No documents yet</h3>
                    <p class="text-gray-600 mb-6">Your documents will appear here once they are uploaded by your realtor.</p>
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md">
                        Contact Your Realtor
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Quick Preview Modal (Hidden by default) -->
<div id="preview-modal" class="hidden fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden">
        <div class="p-4 border-b border-gray-200 flex justify-between items-center bg-gray-800 text-white">
            <h3 class="font-semibold">Document Preview</h3>
            <button onclick="document.getElementById('preview-modal').classList.add('hidden')" class="text-gray-300 hover:text-white">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="p-4 bg-gray-200 overflow-y-auto" style="max-height: calc(90vh - 60px);">
            <div class="bg-white shadow-lg mx-auto p-12" style="width: 8.5in; min-height: 11in;">
                <!-- Document content will be loaded here -->
                <p class="text-gray-600">Loading document...</p>
            </div>
        </div>
    </div>
</div>
@endsection
