<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Dash1 extends Component
{
    public function dehydrate()
    {
        $this->dispatchBrowserEvent('initSomething');
        $this->dispatchBrowserEvent('additionalInit');
    }
    public function render()
    {
        $date_string = date("d.m.Y");
        $u_id = Auth::user()->id;

        $time = DB::select('SELECT time_name FROM time
        JOIN line_assign ON "time".assign_id="line_assign".assign_id AND
        "line_assign".assign_date=\'' . $date_string . '\' GROUP BY time_name ORDER BY time_name DESC OFFSET 1');

        $time_2 = DB::select('SELECT "time".time_id,"time".time_name,"time".line_id,"time".assign_id,"time".status,"time".div_target,"time".div_actual_target,"time".div_actual_percent,"time".actual_target_entry FROM time,line_assign WHERE "time".assign_id="line_assign".assign_id AND "line_assign".assign_date=\'' . $date_string . '\'
        ORDER BY "time".time_id ASC');

        $getLine = DB::select('SELECT "line".l_id,"line".l_name,"line_assign".assign_id,"line_assign".main_target,"line_assign".s_time,"line_assign".e_time,"line_assign".lunch_s_time,"line_assign".lunch_e_time,"line_assign".assign_date,"users".id,"users".name
        FROM line
        JOIN line_assign ON "line_assign".l_id = "line".l_id
        JOIN users ON "users".id= "line_assign".user_id
		JOIN time ON "time".line_id="line".l_id
        WHERE "line".a_status=1 AND "line_assign".assign_date=\'' . $date_string . '\' AND "time".assign_date=\'' . $date_string . '\'
		GROUP BY "line".l_id,"line_assign".assign_id,"users".id
		ORDER BY "line".l_pos ASC');

        $total_main_target = DB::select('SELECT SUM("line_assign".main_target) AS t_main_target FROM line_assign WHERE "line_assign".assign_date=\'' . $date_string . '\'');

        $total_div_target = DB::select('SELECT ROW_NUMBER() OVER(ORDER BY "time".time_name ASC) AS row_num_1,SUM("time".div_target) AS t_div_target,"time".time_name FROM time WHERE "time".assign_date=\'' . $date_string . '\'
        GROUP BY "time".time_name ORDER BY "time".time_name DESC OFFSET 1');

        $total_div_actual_target = DB::select('SELECT ROW_NUMBER() OVER(ORDER BY "time".time_name ASC) AS row_num,SUM("time".div_actual_target) AS t_div_actual_target_1,"time".time_name FROM time WHERE "time".assign_date=\'' . $date_string . '\'
        GROUP BY "time".time_name ORDER BY "time".time_name DESC OFFSET 1');

        DB::disconnect('musung');

        return view(
            'livewire.dash1',
            compact('getLine', 'time', 'time_2', 'total_main_target', 'total_div_target', 'total_div_actual_target'),
        );
    }
}
