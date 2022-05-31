<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineEntryHistory extends Model
{
    use HasFactory;

    protected $table = 'line_entry_history';
    protected $fillable = ['time_id', 'l_id', 'p_id', 'actual_target', 'assign_date', 'status', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
}
