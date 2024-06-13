<?php

namespace App\Interfaces\InvoiceArchive;

interface InvoiceArchiveRepositoryInterface
{
    public function index();

    public function update($request);

    public function destroy($request);
}
