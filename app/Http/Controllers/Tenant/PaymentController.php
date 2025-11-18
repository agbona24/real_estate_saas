<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Show payment schedule page
     */
    public function schedule(Request $request)
    {
        $tenantId = $request->user()->tenant_id;

        $payments = Payment::where('tenant_id', $tenantId)
            ->where('status', 'scheduled')
            ->orderBy('due_date', 'asc')
            ->get();

        return view('tenant.payments.schedule', compact('payments'));
    }

    /**
     * Show payment recording page
     */
    public function record()
    {
        return view('tenant.payments.record');
    }

    /**
     * Store a newly recorded payment
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'payment_date' => 'required|date',
            'reference' => 'nullable|string',
        ]);

        $validated['tenant_id'] = $request->user()->tenant_id;
        $validated['status'] = 'completed';

        Payment::create($validated);

        return redirect()->route('tenant.payments.schedule')
            ->with('success', 'Payment recorded successfully');
    }

    /**
     * Show payment receipt
     */
    public function receipt($id)
    {
        $payment = Payment::where('tenant_id', auth()->user()->tenant_id)
            ->with(['client', 'transaction'])
            ->findOrFail($id);

        return view('tenant.payments.receipt', compact('payment'));
    }
}
