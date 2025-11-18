<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * DocumentController
 *
 * Manages documents within an agency.
 */
class DocumentController extends Controller
{
    /**
     * Display a listing of documents.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data - will be replaced with actual database queries
        $documents = [
            (object)[
                'id' => 1,
                'name' => 'Purchase Agreement - Downtown Condo',
                'type' => 'Contract',
                'category' => 'Transaction',
                'file_path' => 'documents/purchase-agreement.pdf',
                'file_size' => 245000,
                'related_to' => 'Transaction #1',
                'uploaded_by' => 'John Smith',
                'created_at' => now()->subDays(5),
            ],
            (object)[
                'id' => 2,
                'name' => 'Property Inspection Report',
                'type' => 'Report',
                'category' => 'Property',
                'file_path' => 'documents/inspection-report.pdf',
                'file_size' => 1520000,
                'related_to' => 'Property #1',
                'uploaded_by' => 'Emily Davis',
                'created_at' => now()->subDays(10),
            ],
            (object)[
                'id' => 3,
                'name' => 'Client ID Verification',
                'type' => 'Identification',
                'category' => 'Client',
                'file_path' => 'documents/client-id.pdf',
                'file_size' => 850000,
                'related_to' => 'Client: Robert Martinez',
                'uploaded_by' => 'David Wilson',
                'created_at' => now()->subDays(15),
            ],
        ];

        return view('agency.documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new document.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tenantId = auth()->user()->tenant_id;

        return view('agency.documents.create');
    }

    /**
     * Store a newly created document in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:Contract,Report,Identification,Other'],
            'category' => ['required', 'in:Transaction,Property,Client,Agency'],
            'file' => ['required', 'file', 'max:10240'], // 10MB max
            'description' => ['nullable', 'string'],
            'related_id' => ['nullable', 'integer'],
            'related_type' => ['nullable', 'string'],
        ]);

        $validated['tenant_id'] = auth()->user()->tenant_id;
        $validated['uploaded_by'] = auth()->id();

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $validated['file_path'] = $file->store('documents', 'private');
            $validated['file_size'] = $file->getSize();
            $validated['file_type'] = $file->getClientOriginalExtension();
        }

        // TODO: Create document in database
        // Document::create($validated);

        return redirect()->route('agency.documents.index')->with('success', 'Document uploaded successfully.');
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

        // Demo data
        $document = (object)[
            'id' => $id,
            'name' => 'Purchase Agreement - Downtown Condo',
            'type' => 'Contract',
            'category' => 'Transaction',
            'file_path' => 'documents/purchase-agreement.pdf',
            'file_size' => 245000,
            'file_type' => 'pdf',
            'description' => 'Official purchase agreement for the downtown condo transaction',
            'related_to' => 'Transaction #1',
            'uploaded_by' => 'John Smith',
            'created_at' => now()->subDays(5),
        ];

        return view('agency.documents.show', compact('document'));
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

        // TODO: Get document from database and verify tenant
        // $document = Document::where('tenant_id', $tenantId)->findOrFail($id);
        // return Storage::disk('private')->download($document->file_path, $document->name);

        return back()->with('info', 'Download functionality will be implemented.');
    }

    /**
     * Show the form for editing the specified document.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $tenantId = auth()->user()->tenant_id;

        // Demo data
        $document = (object)[
            'id' => $id,
            'name' => 'Purchase Agreement - Downtown Condo',
            'type' => 'Contract',
            'category' => 'Transaction',
            'description' => 'Official purchase agreement',
        ];

        return view('agency.documents.edit', compact('document'));
    }

    /**
     * Update the specified document in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $tenantId = auth()->user()->tenant_id;

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:Contract,Report,Identification,Other'],
            'category' => ['required', 'in:Transaction,Property,Client,Agency'],
            'description' => ['nullable', 'string'],
        ]);

        // TODO: Update document in database
        // $document = Document::where('tenant_id', $tenantId)->findOrFail($id);
        // $document->update($validated);

        return redirect()->route('agency.documents.index')->with('success', 'Document updated successfully.');
    }

    /**
     * Remove the specified document from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $tenantId = auth()->user()->tenant_id;

        // TODO: Delete document and file
        // $document = Document::where('tenant_id', $tenantId)->findOrFail($id);
        // Storage::disk('private')->delete($document->file_path);
        // $document->delete();

        return redirect()->route('agency.documents.index')->with('success', 'Document deleted successfully.');
    }
}
