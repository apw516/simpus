<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $table = 'mt_unit';
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $guarded = ['id'];
}
