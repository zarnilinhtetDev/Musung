<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineAssign extends Model
{
    use HasFactory;
    protected $table = 'line_assign';
    protected $fillable = ['user_id', 'l_id', 'main_target', 'ot_main_target', 'm_power', 'actual_m_power', 'man_target', 'man_actual_target', 'hp', 'actual_hp', 's_time', 'e_time', 'lunch_s_time', 'lunch_e_time', 'cal_work_min', 't_work_hr', 'assign_date', 'div_actual_target', 'div_actual_percent', 'remark', 'created_at', 'updated_at'];
    protected $primaryKey = 'assign_id';
}
