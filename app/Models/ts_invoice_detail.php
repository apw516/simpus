<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ts_invoice_detail extends Model
{
    use HasFactory;
    protected $table = 'ts_invoice_detail';
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $guarded = ['id'];
}
