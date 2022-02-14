<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $table = 'p_category';
    protected $fillable = ['p_cat_name'];
    protected $primaryKey = 'p_cat_id';
    public $timestamps = false;
}
