<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;
    protected $table = 'data';
    protected $fillable = ['p_detail_id', 'time_id', 'div_actual_target', 'div_actual_percent'];
    protected $primaryKey = 'data_id';
    public $timestamps = false;
}
