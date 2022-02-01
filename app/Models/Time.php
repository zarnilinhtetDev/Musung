<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;
    protected $table = 'time';
    protected $fillable = ['time_name', 'status', 'line_id', 'assign_id', 'div_target'];
    protected $primaryKey = 'time_id';
    public $timestamps = false;
}
