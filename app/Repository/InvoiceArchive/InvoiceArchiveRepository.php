<?php

namespace App\Repository\Invoices;

use App\Interfaces\InvoiceArchive\InvoiceArchiveRepositoryInterface;
use App\Interfaces\Invoices\InvoicesRepositoryInterface;
use App\Interfaces\Users\UserRepositoryInterface;
use App\Models\Invoice;
use App\Models\Invoices_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceArchiveRepository implements InvoiceArchiveRepositoryInterface
{
    public function index()
    {
        $invoices = Invoice::onlyTrashed()->get();
        $total = 0;
        foreach ($invoices as $invoice) {
            foreach ($invoice->details as $detail) {
                $total += $detail->count * $detail->price;
            }
        }
        return view('Dashboard.Invoices.Archive_Invoices', compact('invoices', 'total'));
    }

    public function update($request)
    {
        $id = $request->invoice_id;
        $flight = Invoice::withTrashed()->where('id', $id)->restore();
        session()->flash('restore_invoice');
        return redirect('/invoices');
    }

    public function destroy($request)
    {
        $invoices = Invoice::withTrashed()->where('id', $request->invoice_id)->first();
        $invoices->forceDelete();
        session()->flash('delete_invoice');
        return redirect('/Archive');
    }
}
