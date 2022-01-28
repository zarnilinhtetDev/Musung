<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    use HasFactory;
    protected $table = 'line';
    protected $fillable = ['l_name', 'l_pos', 'a_status', 'created_at', 'updated_at'];
    protected $primaryKey = 'l_id';
}
