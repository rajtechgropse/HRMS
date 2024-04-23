<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class submit_invoices extends Model
{
    use HasFactory;
    protected $fillable = [
        'Projectcompany', 
        'Companyname',
        'Cilentname',
        'Cilentemail',
        'Cilentphone',
        'Address',
        'Bill_Genrate_Date',
        'DueDate',
        'Description',
        'Quantity',
        'Price',
        'Amount',
        'Total',
        'Comments',
        'PaymentOption',
        'status',
    ];
    protected $table='submit_invoices';
    protected $guarded = [];
}
