<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'invoice_Date',
        'customer_name',
        'user_id',
        'place',
    ];

    protected $dates = ['deleted_at'];

    public function details()
    {
        return $this->hasMany('App\Models\Invoices_details', 'id_Invoice');
    }
}
