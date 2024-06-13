<?php

namespace App\Http\Controllers;

use App\Interfaces\InvoiceArchive\InvoiceArchiveRepositoryInterface;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceArchiveController extends Controller
{
    private $Invoices_archive;

    public function __construct(InvoiceArchiveRepositoryInterface $Invoices_archive)
    {
        $this->Invoices_archive = $Invoices_archive;
    }

    public function index()
    {
        return $this->Invoices_archive->index();
    }

    public function update(Request $request)
    {
        return $this->Invoices_archive->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->Invoices_archive->destroy($request);
    }
}
