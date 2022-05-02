<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemList extends Model
{
    use HasFactory;
    protected $table = 'item';
    protected $fillable = ['item_id', 'item_name', 'active_status', 'remark','created_at', 'updated_at'];
    protected $primaryKey = 'item_id';
}
