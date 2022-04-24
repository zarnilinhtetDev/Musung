<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OverTime extends Model
{
    use HasFactory;
    protected $table = 'overtime';
    protected $fillable = ['l_id', 'ot_target', 'ot_min', 'assign_date', 'created_at', 'updated_at'];
    protected $primaryKey = 'ot_id';
}
