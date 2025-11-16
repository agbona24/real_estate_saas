@extends('layouts.app')

@section('title', 'Sign Document')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <button onclick="window.history.back()" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-arrow-left text-xl"></i>
                    </button>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">E-Signature</h1>
                        <p class="text-sm text-gray-600">{{ $document->name ?? 'Purchase Agreement.pdf' }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                        <i class="fas fa-pen mr-2"></i> Awaiting Your Signature
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Document Viewer -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <!-- Document Preview -->
                    <div class="border-b border-gray-200 bg-gray-800 p-4 flex justify-between items-center">
                        <div class="flex items-center space-x-3 text-white">
                            <i class="fas fa-file-pdf text-2xl text-red-400"></i>
                            <div>
                                <p class="font-medium">{{ $document->name ?? 'Purchase Agreement.pdf' }}</p>
                                <p class="text-xs text-gray-300">{{ $document->pages ?? 8 }} pages • {{ $document->size ?? '2.4 MB' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="bg-gray-700 hover:bg-gray-600 text-white px-3 py-1 rounded text-sm">
                                <i class="fas fa-search-minus"></i>
                            </button>
                            <span class="text-white text-sm">100%</span>
                            <button class="bg-gray-700 hover:bg-gray-600 text-white px-3 py-1 rounded text-sm">
                                <i class="fas fa-search-plus"></i>
                            </button>
                            <button class="bg-gray-700 hover:bg-gray-600 text-white px-3 py-1 rounded text-sm">
                                <i class="fas fa-download"></i>
                            </button>
                        </div>
                    </div>

                    <!-- PDF Viewer Area -->
                    <div class="bg-gray-200 p-8 max-h-[800px] overflow-y-auto" style="min-height: 800px;">
                        <!-- Simulated Document Pages -->
                        @for($page = 1; $page <= ($document->pages ?? 8); $page++)
                            <div class="bg-white shadow-lg mx-auto mb-6 p-12" style="width: 8.5in; min-height: 11in;" x-data="{ showSignature: false, page: {{ $page }} }">
                                <!-- Document Header -->
                                <div class="text-center mb-8 border-b-2 border-gray-800 pb-4">
                                    <h2 class="text-2xl font-bold text-gray-900">PURCHASE AGREEMENT</h2>
                                    <p class="text-sm text-gray-600 mt-2">Transaction Reference: {{ $transaction->reference ?? 'TXN-2025-001' }}</p>
                                </div>

                                <!-- Sample Content -->
                                <div class="space-y-4 text-sm text-gray-800 leading-relaxed">
                                    <p><strong>THIS PURCHASE AGREEMENT</strong> is entered into on {{ $document->date ?? date('F d, Y') }} between:</p>

                                    <div class="ml-6">
                                        <p><strong>SELLER:</strong> {{ $seller->name ?? 'Property Owner LLC' }}</p>
                                        <p>Address: {{ $seller->address ?? '123 Main St, Los Angeles, CA' }}</p>
                                    </div>

                                    <div class="ml-6 mt-4">
                                        <p><strong>BUYER:</strong> {{ $buyer->name ?? auth()->user()->name ?? 'John Doe' }}</p>
                                        <p>Address: {{ $buyer->address ?? '456 Oak Ave, Beverly Hills, CA' }}</p>
                                    </div>

                                    @if($page === 1)
                                        <h3 class="font-bold mt-6">PROPERTY DESCRIPTION:</h3>
                                        <p class="ml-6">{{ $property->description ?? 'A 4-bedroom luxury villa located at Beverly Hills, CA. The property includes 2,500 square feet of living space, 3 bathrooms, 2-car garage, swimming pool, and landscaped garden.' }}</p>

                                        <h3 class="font-bold mt-6">PURCHASE PRICE:</h3>
                                        <p class="ml-6">The total purchase price for the Property is <strong>${{ number_format($transaction->amount ?? 450000, 0) }}</strong> (Four Hundred Fifty Thousand Dollars).</p>

                                        <h3 class="font-bold mt-6">PAYMENT TERMS:</h3>
                                        <ul class="ml-6 list-disc">
                                            <li>Initial Deposit: ${{ number_format($transaction->deposit ?? 45000, 0) }} (10% of purchase price)</li>
                                            <li>Balance Payment: ${{ number_format(($transaction->amount ?? 450000) - ($transaction->deposit ?? 45000), 0) }}</li>
                                            <li>Due Date: {{ $transaction->balance_due_date ?? 'December 15, 2025' }}</li>
                                        </ul>
                                    @endif

                                    @if($page === 2)
                                        <h3 class="font-bold">TERMS AND CONDITIONS:</h3>
                                        <ol class="ml-6 list-decimal space-y-2">
                                            <li><strong>Closing Date:</strong> The closing of this transaction shall occur on or before {{ $transaction->closing_date ?? 'December 31, 2025' }}.</li>
                                            <li><strong>Inspections:</strong> The Buyer shall have the right to conduct property inspections within 14 days of signing this agreement.</li>
                                            <li><strong>Title:</strong> The Seller shall provide clear and marketable title to the Property at closing.</li>
                                            <li><strong>Contingencies:</strong> This agreement is contingent upon the Buyer obtaining financing approval within 30 days.</li>
                                            <li><strong>Default:</strong> In the event of default by either party, the non-defaulting party shall be entitled to all remedies available under law.</li>
                                        </ol>
                                    @endif

                                    @if($page === ($document->pages ?? 8))
                                        <!-- Signature Section -->
                                        <div class="mt-12 pt-8 border-t-2 border-gray-300">
                                            <h3 class="font-bold mb-6">SIGNATURES:</h3>

                                            <!-- Seller Signature -->
                                            <div class="mb-8">
                                                <p class="font-semibold mb-2">SELLER:</p>
                                                <div class="border-b-2 border-gray-800 w-64 mb-2">
                                                    @if($seller_signature ?? false)
                                                        <img src="{{ $seller_signature }}" alt="Seller Signature" class="h-16">
                                                    @else
                                                        <div class="h-16 flex items-center">
                                                            <p class="text-gray-400 italic">Digitally Signed</p>
                                                        </div>
                                                    @endif
                                                </div>
                                                <p class="text-sm text-gray-600">{{ $seller->name ?? 'Property Owner LLC' }}</p>
                                                <p class="text-xs text-gray-500">Date: {{ $seller->signature_date ?? 'November 10, 2025' }}</p>
                                            </div>

                                            <!-- Buyer Signature Area -->
                                            <div class="mb-8" id="buyer-signature-section">
                                                <p class="font-semibold mb-2">BUYER:</p>
                                                @if($document->signed ?? false)
                                                    <!-- Already Signed -->
                                                    <div class="border-2 border-green-500 rounded-lg p-4 bg-green-50">
                                                        <div class="border-b-2 border-gray-800 w-64 mb-2">
                                                            <img src="{{ $buyer_signature ?? '/api/placeholder/200/50' }}" alt="Your Signature" class="h-16">
                                                        </div>
                                                        <p class="text-sm text-gray-600">{{ $buyer->name ?? auth()->user()->name ?? 'John Doe' }}</p>
                                                        <p class="text-xs text-gray-500">Date: {{ $buyer->signature_date ?? date('F d, Y') }}</p>
                                                        <div class="mt-2 flex items-center text-green-600">
                                                            <i class="fas fa-check-circle mr-2"></i>
                                                            <span class="text-sm font-medium">Electronically Signed</span>
                                                        </div>
                                                    </div>
                                                @else
                                                    <!-- Click to Sign -->
                                                    <div class="border-2 border-dashed border-yellow-400 rounded-lg p-6 bg-yellow-50 cursor-pointer hover:bg-yellow-100 transition"
                                                         onclick="document.getElementById('signature-modal').classList.remove('hidden')">
                                                        <div class="text-center">
                                                            <i class="fas fa-pen-fancy text-yellow-600 text-3xl mb-3"></i>
                                                            <p class="font-semibold text-gray-900">Click here to sign</p>
                                                            <p class="text-sm text-gray-600 mt-1">{{ $buyer->name ?? auth()->user()->name ?? 'John Doe' }}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Page Number -->
                                <div class="mt-8 pt-4 border-t border-gray-300 text-center text-xs text-gray-500">
                                    Page {{ $page }} of {{ $document->pages ?? 8 }}
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Signature Status -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-clipboard-check mr-2 text-indigo-600"></i>
                        Signature Progress
                    </h3>

                    <div class="space-y-4">
                        <!-- Seller Signature -->
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 mt-1">
                                <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center">
                                    <i class="fas fa-check text-green-600"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Seller</p>
                                <p class="text-xs text-gray-600">{{ $seller->name ?? 'Property Owner LLC' }}</p>
                                <p class="text-xs text-green-600 mt-1">
                                    <i class="fas fa-check-circle mr-1"></i> Signed on {{ $seller->signature_date ?? 'Nov 10, 2025' }}
                                </p>
                            </div>
                        </div>

                        <!-- Buyer Signature -->
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 mt-1">
                                <div class="h-8 w-8 rounded-full {{ ($document->signed ?? false) ? 'bg-green-100' : 'bg-yellow-100' }} flex items-center justify-center">
                                    <i class="fas fa-{{ ($document->signed ?? false) ? 'check' : 'hourglass-half' }} {{ ($document->signed ?? false) ? 'text-green-600' : 'text-yellow-600' }}"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Buyer (You)</p>
                                <p class="text-xs text-gray-600">{{ $buyer->name ?? auth()->user()->name ?? 'John Doe' }}</p>
                                @if($document->signed ?? false)
                                    <p class="text-xs text-green-600 mt-1">
                                        <i class="fas fa-check-circle mr-1"></i> Signed on {{ $buyer->signature_date ?? date('M d, Y') }}
                                    </p>
                                @else
                                    <p class="text-xs text-yellow-600 mt-1">
                                        <i class="fas fa-pen mr-1"></i> Awaiting your signature
                                    </p>
                                @endif
                            </div>
                        </div>

                        @if($witness_required ?? false)
                            <!-- Witness Signature -->
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center">
                                        <i class="fas fa-clock text-gray-400"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Witness</p>
                                    <p class="text-xs text-gray-600">Pending</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Action Required -->
                @if(!($document->signed ?? false))
                    <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 border-2 border-yellow-300 rounded-lg shadow-lg p-6">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-pen-fancy text-white text-2xl"></i>
                            </div>
                            <h3 class="font-bold text-gray-900 mb-2">Action Required</h3>
                            <p class="text-sm text-gray-700 mb-4">Please review and sign this document to proceed with the transaction.</p>
                            <button onclick="document.getElementById('signature-modal').classList.remove('hidden')" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg font-semibold text-lg">
                                <i class="fas fa-pen mr-2"></i> Sign Now
                            </button>
                        </div>
                    </div>
                @else
                    <div class="bg-gradient-to-br from-green-50 to-green-100 border-2 border-green-300 rounded-lg shadow-lg p-6">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-check-circle text-white text-2xl"></i>
                            </div>
                            <h3 class="font-bold text-gray-900 mb-2">Document Signed</h3>
                            <p class="text-sm text-gray-700 mb-4">You have successfully signed this document.</p>
                            <button class="w-full bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg font-semibold">
                                <i class="fas fa-download mr-2"></i> Download Copy
                            </button>
                        </div>
                    </div>
                @endif

                <!-- Document Info -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="font-semibold text-gray-900 mb-4">Document Information</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Document Type</span>
                            <span class="font-medium text-gray-900">{{ $document->category ?? 'Purchase Agreement' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Transaction</span>
                            <span class="font-medium text-gray-900">{{ $transaction->reference ?? 'TXN-2025-001' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Uploaded</span>
                            <span class="font-medium text-gray-900">{{ $document->uploaded_at ?? 'Nov 10, 2025' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Expires</span>
                            <span class="font-medium text-gray-900">{{ $document->expires_at ?? 'Dec 10, 2025' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Security Notice -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-shield-alt text-blue-600 text-xl mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-blue-900 text-sm mb-1">Secure E-Signature</h4>
                            <p class="text-xs text-blue-800">Your signature is encrypted and legally binding. This document uses blockchain verification for authenticity.</p>
                        </div>
                    </div>
                </div>

                <!-- Help -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="font-semibold text-gray-900 mb-3">Need Help?</h3>
                    <p class="text-sm text-gray-600 mb-4">If you have questions about this document, contact your realtor:</p>
                    <div class="flex items-center space-x-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($realtor->name ?? 'Agent') }}" class="h-10 w-10 rounded-full" alt="">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $realtor->name ?? 'Sarah Johnson' }}</p>
                            <p class="text-xs text-gray-500">{{ $realtor->phone ?? '+1 (555) 123-4567' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Signature Modal -->
<div id="signature-modal" class="hidden fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50" x-data="{ signatureType: 'draw', signature: '' }">
    <div class="bg-white rounded-lg shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-900">Sign Document</h2>
                <button onclick="document.getElementById('signature-modal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
        </div>

        <div class="p-6">
            <!-- Signature Type Selection -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-3">Choose signature method:</label>
                <div class="grid grid-cols-3 gap-3">
                    <button @click="signatureType = 'draw'" :class="signatureType === 'draw' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 border border-gray-300'" class="px-4 py-3 rounded-lg font-medium hover:shadow-md transition">
                        <i class="fas fa-pen mb-1"></i><br>
                        Draw
                    </button>
                    <button @click="signatureType = 'type'" :class="signatureType === 'type' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 border border-gray-300'" class="px-4 py-3 rounded-lg font-medium hover:shadow-md transition">
                        <i class="fas fa-keyboard mb-1"></i><br>
                        Type
                    </button>
                    <button @click="signatureType = 'upload'" :class="signatureType === 'upload' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 border border-gray-300'" class="px-4 py-3 rounded-lg font-medium hover:shadow-md transition">
                        <i class="fas fa-upload mb-1"></i><br>
                        Upload
                    </button>
                </div>
            </div>

            <!-- Draw Signature -->
            <div x-show="signatureType === 'draw'" class="space-y-4">
                <label class="block text-sm font-medium text-gray-700">Draw your signature below:</label>
                <div class="border-2 border-gray-300 rounded-lg bg-white" style="height: 200px;">
                    <canvas id="signature-canvas" class="w-full h-full cursor-crosshair"></canvas>
                </div>
                <div class="flex justify-between">
                    <button onclick="clearCanvas()" class="text-sm text-gray-600 hover:text-gray-800">
                        <i class="fas fa-eraser mr-1"></i> Clear
                    </button>
                </div>
            </div>

            <!-- Type Signature -->
            <div x-show="signatureType === 'type'" class="space-y-4">
                <label class="block text-sm font-medium text-gray-700">Type your full name:</label>
                <input x-model="signature" type="text" placeholder="John Doe" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-lg focus:ring-indigo-500 focus:border-indigo-500">
                <div class="border-2 border-gray-200 rounded-lg bg-gray-50 p-8 text-center" style="height: 150px; display: flex; align-items: center; justify-content: center;">
                    <p x-text="signature || 'Your signature will appear here'" class="text-5xl font-signature text-gray-900" style="font-family: 'Dancing Script', cursive;"></p>
                </div>
            </div>

            <!-- Upload Signature -->
            <div x-show="signatureType === 'upload'" class="space-y-4">
                <label class="block text-sm font-medium text-gray-700">Upload signature image:</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-indigo-500 cursor-pointer">
                    <i class="fas fa-cloud-upload-alt text-gray-400 text-4xl mb-3"></i>
                    <p class="text-gray-600">Click to upload or drag and drop</p>
                    <p class="text-xs text-gray-500 mt-1">PNG, JPG up to 5MB</p>
                </div>
            </div>

            <!-- Agreement Checkbox -->
            <div class="mt-6 bg-gray-50 border border-gray-200 rounded-lg p-4">
                <div class="flex items-start">
                    <input type="checkbox" id="agree-terms" class="h-5 w-5 text-indigo-600 rounded mt-0.5">
                    <label for="agree-terms" class="ml-3 text-sm text-gray-700">
                        I agree that my electronic signature has the same legal effect as a handwritten signature. I have read and understood the document and agree to all terms and conditions.
                    </label>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex space-x-3 mt-6">
                <button onclick="document.getElementById('signature-modal').classList.add('hidden')" class="flex-1 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-lg font-semibold">
                    Cancel
                </button>
                <button onclick="submitSignature()" class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-6 py-3 rounded-lg font-semibold">
                    <i class="fas fa-check-circle mr-2"></i> Sign & Submit
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Add Google Fonts for signature font -->
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">

<script>
// Canvas signature drawing functionality
const canvas = document.getElementById('signature-canvas');
if (canvas) {
    const ctx = canvas.getContext('2d');
    canvas.width = canvas.offsetWidth;
    canvas.height = canvas.offsetHeight;

    let isDrawing = false;
    let lastX = 0;
    let lastY = 0;

    canvas.addEventListener('mousedown', (e) => {
        isDrawing = true;
        [lastX, lastY] = [e.offsetX, e.offsetY];
    });

    canvas.addEventListener('mousemove', (e) => {
        if (!isDrawing) return;
        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(e.offsetX, e.offsetY);
        ctx.strokeStyle = '#000';
        ctx.lineWidth = 2;
        ctx.lineCap = 'round';
        ctx.stroke();
        [lastX, lastY] = [e.offsetX, e.offsetY];
    });

    canvas.addEventListener('mouseup', () => isDrawing = false);
    canvas.addEventListener('mouseout', () => isDrawing = false);
}

function clearCanvas() {
    if (canvas) {
        const ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }
}

function submitSignature() {
    // Here you would submit the signature to your backend
    alert('Signature submitted successfully!');
    document.getElementById('signature-modal').classList.add('hidden');
    // Reload or update the page to show signed status
    location.reload();
}
</script>
@endsection
