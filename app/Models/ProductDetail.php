<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $table = 'p_detail';
    protected $fillable = ['assign_id', 'l_id', 'p_cat_id', 'p_name', 'quantity', 'div_quantity', 'sewing_input', 'h_over_input', 'p_actual_target', 'cat_actual_target', 'created_at', 'updated_at'];
    protected $primaryKey = 'p_detail_id';
}
