<?php

namespace App\Repository\Invoices;

use App\Interfaces\Invoices\InvoicesRepositoryInterface;
use App\Interfaces\Users\UserRepositoryInterface;
use App\Models\Invoice;
use App\Models\Invoices_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoicesRepository implements InvoicesRepositoryInterface
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $invoices = Invoice::whereUserId(Auth::user()->id)->get();
        $total = 0;
        foreach ($invoices as $invoice) {
            foreach ($invoice->details as $detail) {
                $total += $detail->count * $detail->price;
            }
        }
        return view('Dashboard.invoices.invoices', compact('invoices', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Invoices_details::select('product')->groupBy('product')->get();
        return view('Dashboard.invoices.add_invoice', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        $invoice = Invoice::create([
            'customer_name' => $request->customer_name,
            'invoice_Date' => $request->invoice_Date,
            'user_id' => Auth::user()->id,
            'place' => $request->place,
        ]);

        for ($index = 1; $index <= 10; $index++) {
            $i = (string)$index;
            $product = 'product_' . $i;
            $count = 'count_' . $i;
            $price = 'price_' . $i;
            $note = 'note_' . $i;
            if ($request->filled($product)) {
                Invoices_details::create([
                    'product' => $request->$product,
                    'count' => $request->$count,
                    'price' => $request->$price,
                    'id_Invoice' => $invoice->id,
                    'note' => $request->$note,
                ]);
            }
        }

        session()->flash('Add', 'تم اضافة الفاتورة بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $invoices = invoice::where('id', $id)->first();
    //     return view('invoices.status_update', compact('invoices'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $invoice = invoice::where('id', $id)->first();
        return view('Dashboard.invoices.edit_invoice', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request)
    {
        $invoice = invoice::findOrFail($request->id);
        $invoice->update([
            'customer_name' => $request->customer_name,
            'invoice_Date' => $request->invoice_Date,
            'user_id' => Auth::user()->id,
            'place' => $request->place,
        ]);

        for ($index = 1; $index <= $request->index; $index++) {
            $i = (string)$index;
            $detail = 'detail_' . $i;
            $product = 'product_' . $i;
            $count = 'count_' . $i;
            $price = 'price_' . $i;
            $note = 'note_' . $i;
            $detail = Invoices_details::find($request->$detail);
            $detail->update([
                'product' => $request->$product,
                'count' => $request->$count,
                'price' => $request->$price,
                'note' => $request->$note,
            ]);
        }

        session()->flash('edit', 'تم تعديل الفاتورة بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($request)
    {
        // return $request;
        $id = $request->invoice_id;
        $invoice = invoice::where('id', $id)->first();

        $id_page = $request->id_page;


        if (!$id_page == 2) {

            $invoice->forceDelete();
            session()->flash('delete_invoice');
            return redirect('/invoices');
        } else {

            $invoice->delete();
            session()->flash('archive_invoice');
            return redirect('/Archive');
        }
    }

    public function Print_invoice($id)
    {
        $invoice = invoice::where('id', $id)->first();
        $total = 0;
        foreach ($invoice->details as $detail) {
            $total += $detail->count * $detail->price;
        }
        return view('Dashboard.invoices.Print_invoice', compact('invoice'));
    }
}
