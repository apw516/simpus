<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasir_detail extends Model
{
    use HasFactory;
    protected $table = 'ts_transaksi_kasir_detail';
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $guarded = ['id'];}
