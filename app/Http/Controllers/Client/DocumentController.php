<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * DocumentController
 *
 * Manages documents for the client.
 */
class DocumentController extends Controller
{
    /**
     * Display a listing of client's documents.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;
        $clientId = auth()->id();

        // Demo data - will be replaced with actual database queries
        $documents = [
            (object)[
                'id' => 1,
                'name' => 'Purchase Agreement - Downtown Penthouse',
                'type' => 'Contract',
                'category' => 'Purchase',
                'property' => 'Downtown Penthouse',
                'file_path' => 'documents/purchase-agreement.pdf',
                'file_size' => 245000,
                'created_at' => now()->subMonths(2),
            ],
            (object)[
                'id' => 2,
                'name' => 'Property Deed - Downtown Penthouse',
                'type' => 'Legal',
                'category' => 'Ownership',
                'property' => 'Downtown Penthouse',
                'file_path' => 'documents/property-deed.pdf',
                'file_size' => 180000,
                'created_at' => now()->subMonths(2),
            ],
            (object)[
                'id' => 3,
                'name' => 'Home Inspection Report',
                'type' => 'Report',
                'category' => 'Purchase',
                'property' => 'Downtown Penthouse',
                'file_path' => 'documents/inspection.pdf',
                'file_size' => 1520000,
                'created_at' => now()->subMonths(2),
            ],
            (object)[
                'id' => 4,
                'name' => 'Purchase Agreement - Suburban Villa',
                'type' => 'Contract',
                'category' => 'Purchase',
                'property' => 'Suburban Villa',
                'file_path' => 'documents/purchase-agreement-2.pdf',
                'file_size' => 230000,
                'created_at' => now()->subMonth(),
            ],
        ];

        return view('client.documents.index', compact('documents'));
    }

    /**
     * Display the specified document.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $tenantId = auth()->user()->tenant_id;
        $clientId = auth()->id();

        // Demo data
        $document = (object)[
            'id' => $id,
            'name' => 'Purchase Agreement - Downtown Penthouse',
            'type' => 'Contract',
            'category' => 'Purchase',
            'property' => 'Downtown Penthouse',
            'file_path' => 'documents/purchase-agreement.pdf',
            'file_size' => 245000,
            'file_type' => 'pdf',
            'description' => 'Official purchase agreement for Downtown Penthouse',
            'created_at' => now()->subMonths(2),
        ];

        return view('client.documents.show', compact('document'));
    }

    /**
     * Download the specified document.
     *
     * @param  int  $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($id)
    {
        $tenantId = auth()->user()->tenant_id;
        $clientId = auth()->id();

        // TODO: Get document from database and verify client ownership
        // $document = Document::where('tenant_id', $tenantId)
        //     ->where('client_id', $clientId)
        //     ->findOrFail($id);
        // return Storage::disk('private')->download($document->file_path, $document->name);

        return back()->with('info', 'Download functionality will be implemented.');
    }

    /**
     * Upload a new document.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:Identification,Financial,Other'],
            'file' => ['required', 'file', 'max:10240'], // 10MB max
            'description' => ['nullable', 'string'],
        ]);

        $validated['tenant_id'] = auth()->user()->tenant_id;
        $validated['client_id'] = auth()->id();

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $validated['file_path'] = $file->store('client-documents', 'private');
            $validated['file_size'] = $file->getSize();
            $validated['file_type'] = $file->getClientOriginalExtension();
        }

        // TODO: Create document in database
        // Document::create($validated);

        return back()->with('success', 'Document uploaded successfully.');
    }
}
