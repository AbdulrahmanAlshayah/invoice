<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;
    use SoftDeletes;
    protected $fillable = [
        'invoice_Date',
        'customer_name',
    ];

    protected $dates = ['deleted_at'];
}
