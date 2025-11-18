<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use Illuminate\Http\Request;

/**
 * SupportController
 *
 * Manages support tickets and inquiries for the client.
 */
class SupportController extends Controller
{
    /**
     * Display a listing of support tickets.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tenantId = auth()->user()->tenant_id;
        $clientId = auth()->id();

        // Demo data - will be replaced with actual database queries
        $tickets = [
            (object)[
                'id' => 1,
                'ticket_number' => 'TICKET-2024-001',
                'subject' => 'Question about closing process',
                'category' => 'General Inquiry',
                'priority' => 'medium',
                'status' => 'open',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDay(),
                'replies_count' => 2,
            ],
            (object)[
                'id' => 2,
                'ticket_number' => 'TICKET-2024-002',
                'subject' => 'Document access issue',
                'category' => 'Technical',
                'priority' => 'high',
                'status' => 'in_progress',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(3),
                'replies_count' => 4,
            ],
            (object)[
                'id' => 3,
                'ticket_number' => 'TICKET-2024-003',
                'subject' => 'Payment confirmation request',
                'category' => 'Billing',
                'priority' => 'low',
                'status' => 'resolved',
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(8),
                'replies_count' => 3,
            ],
        ];

        return view('client.support.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new support ticket.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('client.support.create');
    }

    /**
     * Store a newly created support ticket.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:General Inquiry,Technical,Billing,Property,Other'],
            'priority' => ['required', 'in:low,medium,high'],
            'message' => ['required', 'string'],
            'attachments.*' => ['nullable', 'file', 'max:5120'],
        ]);

        $validated['tenant_id'] = auth()->user()->tenant_id;
        $validated['client_id'] = auth()->id();
        $validated['status'] = 'open';
        $validated['ticket_number'] = 'TICKET-' . date('Y') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

        // Handle attachments
        if ($request->hasFile('attachments')) {
            $attachments = [];
            foreach ($request->file('attachments') as $file) {
                $attachments[] = $file->store('support-attachments', 'private');
            }
            $validated['attachments'] = json_encode($attachments);
        }

        // TODO: Create support ticket in database
        // SupportTicket::create($validated);

        return redirect()->route('client.support.index')->with('success', 'Support ticket created successfully. We will respond soon.');
    }

    /**
     * Display the specified support ticket.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $tenantId = auth()->user()->tenant_id;
        $clientId = auth()->id();

        // Demo data
        $ticket = (object)[
            'id' => $id,
            'ticket_number' => 'TICKET-2024-001',
            'subject' => 'Question about closing process',
            'category' => 'General Inquiry',
            'priority' => 'medium',
            'status' => 'open',
            'message' => 'I have some questions about the closing process for my property purchase. Can you help?',
            'created_at' => now()->subDays(2),
            'updated_at' => now()->subDay(),
        ];

        $replies = [
            (object)[
                'id' => 1,
                'user' => 'Support Agent',
                'user_type' => 'staff',
                'message' => 'Thank you for contacting us. We would be happy to help you with the closing process.',
                'created_at' => now()->subDay(),
            ],
            (object)[
                'id' => 2,
                'user' => auth()->user()->name,
                'user_type' => 'client',
                'message' => 'Specifically, I want to know what documents I need to bring to the closing.',
                'created_at' => now()->subDay()->addHours(2),
            ],
            (object)[
                'id' => 3,
                'user' => 'John Smith (Realtor)',
                'user_type' => 'realtor',
                'message' => 'You will need to bring: 1) Photo ID, 2) Proof of homeowners insurance, 3) Cashier\'s check for closing costs. I will send you a complete checklist via email.',
                'created_at' => now()->subDay()->addHours(3),
            ],
        ];

        return view('client.support.show', compact('ticket', 'replies'));
    }

    /**
     * Add a reply to a support ticket.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reply(Request $request, $id)
    {
        $validated = $request->validate([
            'message' => ['required', 'string'],
            'attachments.*' => ['nullable', 'file', 'max:5120'],
        ]);

        $validated['ticket_id'] = $id;
        $validated['user_id'] = auth()->id();
        $validated['user_type'] = 'client';

        // Handle attachments
        if ($request->hasFile('attachments')) {
            $attachments = [];
            foreach ($request->file('attachments') as $file) {
                $attachments[] = $file->store('support-attachments', 'private');
            }
            $validated['attachments'] = json_encode($attachments);
        }

        // TODO: Create reply in database

        return back()->with('success', 'Reply added successfully.');
    }

    /**
     * Close a support ticket.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function close($id)
    {
        $tenantId = auth()->user()->tenant_id;
        $clientId = auth()->id();

        // TODO: Update ticket status to 'resolved'
        // $ticket = SupportTicket::where('tenant_id', $tenantId)
        //     ->where('client_id', $clientId)
        //     ->findOrFail($id);
        // $ticket->update(['status' => 'resolved']);

        return back()->with('success', 'Support ticket closed successfully.');
    }

    /**
     * Display FAQ page.
     *
     * @return \Illuminate\View\View
     */
    public function faq()
    {
        $faqs = [
            (object)[
                'category' => 'General',
                'questions' => [
                    (object)['question' => 'How do I access my documents?', 'answer' => 'You can access all your documents from the Documents section in your dashboard.'],
                    (object)['question' => 'How can I contact my realtor?', 'answer' => 'Your realtor\'s contact information is available on each property page and transaction.'],
                ],
            ],
            (object)[
                'category' => 'Payments',
                'questions' => [
                    (object)['question' => 'What payment methods do you accept?', 'answer' => 'We accept credit cards, debit cards, and bank transfers.'],
                    (object)['question' => 'How do I download a receipt?', 'answer' => 'You can download receipts from the Payments section by clicking the download button next to each payment.'],
                ],
            ],
            (object)[
                'category' => 'Properties',
                'questions' => [
                    (object)['question' => 'How do I view available properties?', 'answer' => 'Navigate to the Browse Properties section to see all available listings.'],
                    (object)['question' => 'Can I schedule a property viewing?', 'answer' => 'Yes, you can express interest in a property and a realtor will contact you to schedule a viewing.'],
                ],
            ],
        ];

        return view('client.support.faq', compact('faqs'));
    }
}
