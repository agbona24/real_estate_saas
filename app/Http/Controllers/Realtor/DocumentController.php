<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * DocumentController
 *
 * Manages documents for the realtor.
 */
class DocumentController extends Controller
{
    /**
     * Display a listing of the realtor's documents.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $tenantId = auth()->user()->tenant_id;
        $realtorId = auth()->id();

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
                'created_at' => now()->subDays(10),
            ],
            (object)[
                'id' => 3,
                'name' => 'Client Authorization Form',
                'type' => 'Form',
                'category' => 'Client',
                'file_path' => 'documents/auth-form.pdf',
                'file_size' => 180000,
                'related_to' => 'Client: Robert Martinez',
                'created_at' => now()->subDays(15),
            ],
        ];

        return view('realtor.documents.index', compact('documents'));
    }

    /**
     * Show the form for uploading a new document.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('realtor.documents.create');
    }

    /**
     * Store a newly uploaded document in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:Contract,Report,Form,Other'],
            'category' => ['required', 'in:Transaction,Property,Client,Personal'],
            'file' => ['required', 'file', 'max:10240'], // 10MB max
            'description' => ['nullable', 'string'],
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

        return redirect()->route('realtor.documents.index')->with('success', 'Document uploaded successfully.');
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
        $realtorId = auth()->id();

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
            'created_at' => now()->subDays(5),
        ];

        return view('realtor.documents.show', compact('document'));
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
        $realtorId = auth()->id();

        // TODO: Get document from database and verify ownership
        // $document = Document::where('tenant_id', $tenantId)
        //     ->where('uploaded_by', $realtorId)
        //     ->findOrFail($id);
        // return Storage::disk('private')->download($document->file_path, $document->name);

        return back()->with('info', 'Download functionality will be implemented.');
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
        $realtorId = auth()->id();

        // TODO: Delete document and file
        // $document = Document::where('tenant_id', $tenantId)
        //     ->where('uploaded_by', $realtorId)
        //     ->findOrFail($id);
        // Storage::disk('private')->delete($document->file_path);
        // $document->delete();

        return redirect()->route('realtor.documents.index')->with('success', 'Document deleted successfully.');
    }
}
