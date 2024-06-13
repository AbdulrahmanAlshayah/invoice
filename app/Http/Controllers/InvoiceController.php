<?php

namespace App\Http\Controllers;

use App\Interfaces\Invoices\InvoicesRepositoryInterface;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    private $Invoices;

    public function __construct(InvoicesRepositoryInterface $Invoices)
    {
        $this->Invoices = $Invoices;
    }
    public function index()
    {
        return $this->Invoices->index();
    }
    public function create()
    {
        return $this->Invoices->create();
    }
    public function store(Request $request)
    {
        return $this->Invoices->store($request);
    }
    public function edit($id)
    {
        return $this->Invoices->edit($id);
    }
    public function update(Request $request)
    {
        return $this->Invoices->update($request);
    }
    public function destroy(Request $request)
    {
        return $this->Invoices->destroy($request);
    }

    public function Print_invoice($id)
    {
        return $this->Invoices->Print_invoice($id);
    }
}
