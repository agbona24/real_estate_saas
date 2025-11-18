<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of transactions for the tenant
     */
    public function index(Request $request)
    {
        $tenantId = $request->user()->tenant_id;

        $transactions = Transaction::where('tenant_id', $tenantId)
            ->with(['property', 'client'])
            ->orderBy('created_at', 'desc')
            ->get();

        $stats = [
            'total' => $transactions->count(),
            'pending' => $transactions->where('status', 'pending')->count(),
            'completed' => $transactions->where('status', 'completed')->count(),
            'total_amount' => $transactions->where('status', 'completed')->sum('amount'),
        ];

        return view('tenant.transactions.index', compact('transactions', 'stats'));
    }

    /**
     * Display the specified transaction
     */
    public function show($id)
    {
        $transaction = Transaction::where('tenant_id', auth()->user()->tenant_id)
            ->with(['property', 'client', 'realtor'])
            ->findOrFail($id);

        return view('tenant.transactions.show', compact('transaction'));
    }

    /**
     * Update the specified transaction
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::where('tenant_id', auth()->user()->tenant_id)
            ->findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $transaction->update($validated);

        return redirect()->route('tenant.transactions.index')
            ->with('success', 'Transaction updated successfully');
    }
}
