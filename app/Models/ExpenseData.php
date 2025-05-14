<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseData extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'expense_category',
        'expense_name',
        'payment_method',
        'expense_date',
        'expense_amount',
        'expense_description',
    ];
}
