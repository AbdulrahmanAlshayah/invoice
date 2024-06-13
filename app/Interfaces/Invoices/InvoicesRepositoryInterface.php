<?php

namespace App\Interfaces\Invoices;

interface InvoicesRepositoryInterface
{
    // get Invoices
    public function index();

    // create Invoices
    public function create();

    public function store($request);

    // public function show($id);

    public function edit($id);

    public function update($request);

    public function destroy($request);

    public function Print_invoice($id);
}
