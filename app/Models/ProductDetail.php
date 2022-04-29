<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $table = 'p_detail';
    protected $fillable = ['assign_id', 'l_id', 'p_cat_id', 'p_name', 'style_no', 'quantity', 'order_quantity', 'div_quantity', 'sewing_input', 'h_over_input', 'h_balance', 'p_actual_target', 'cat_actual_target', 'inline', 'cmp', 'ot_status', 'created_at', 'updated_at'];
    protected $primaryKey = 'p_detail_id';
}
