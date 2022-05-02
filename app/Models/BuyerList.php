<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerList extends Model
{
    use HasFactory;
    protected $table = 'buyer';
    protected $fillable = ['buyer_id', 'buyer_name', 'active_status','remark', 'created_at', 'updated_at'];
    protected $primaryKey = 'buyer_id';
}
