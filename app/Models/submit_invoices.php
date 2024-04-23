<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class submit_invoices extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'usersId',
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


    public function project()
    {
        return $this->belongsTo(AddProjects::class, 'project_id');
    }

    protected $table = 'submit_invoices';
    protected $guarded = [];
}
