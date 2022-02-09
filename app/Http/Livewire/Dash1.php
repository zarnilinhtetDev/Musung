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
    }
    public function render()
    {
        $date_string = date("d.m.Y");
        $u_id = Auth::user()->id;

        // $responseBody = DB::select('SELECT "line".l_id,"line".l_name,"line_assign".assign_id,"line_assign".main_target,
        // "line_assign".s_time,"line_assign".e_time,"line_assign".lunch_s_time,"line_assign".lunch_e_time,
        // "line_assign".assign_date,"time".time_id,"time".time_name,"time".status,"time".div_target,
        // "time".actual_target_entry,"time".div_actual_target,"time".div_actual_percent
        //         FROM line
        //         JOIN line_assign ON "line_assign".l_id = "line".l_id AND "line_assign".assign_date=\'' . $date_string . '\'
        //         JOIN time ON "time".line_id = "line_assign".l_id ORDER BY "time".time_id ASC');

        // $p_detail = DB::select('SELECT "p_detail".p_detail_id,"p_detail".assign_id,"p_detail".l_id,"p_detail".p_cat_id,"p_detail".p_name,"p_detail".quantity FROM p_detail,line_assign WHERE "p_detail".assign_id="line_assign".assign_id AND "line_assign".assign_date=\'' . $date_string . '\' ORDER BY "p_detail".p_detail_id ASC');
        // // ProductDetail::select(DB::raw(
        // //     '"p_detail".p_detail_id,"p_detail".assign_id,"p_detail".l_id,"p_detail".p_cat_id,"p_detail".p_name,"p_detail".quantity'
        // // ))->orderBy('p_detail_id', 'asc')->get();

        // $line = DB::select('SELECT "line".l_id,"line".l_name FROM line,line_assign WHERE "line".a_status=1 AND "line".is_delete=0 AND "line".l_id="line_assign".l_id AND "line_assign".assign_date=\'' . $date_string . '\' ORDER BY "line".l_pos ASC');
        // // Line::table()->where('a_status', 1)->orderBy('l_pos', 'asc')->get();

        $time = DB::select('SELECT time_name FROM time
        JOIN line_assign ON "time".assign_id="line_assign".assign_id AND
        "line_assign".assign_date=\'' . $date_string . '\' GROUP BY time_name ORDER BY time_name ASC');
        // Time::select('time_name')->groupBy('time_name')->orderBy('time_name', 'asc')->get();

        $time_2 = DB::select('SELECT "time".time_id,"time".time_name,"time".line_id,"time".assign_id,"time".status,"time".div_target,"time".div_actual_target,"time".div_actual_percent,"time".actual_target_entry FROM time,line_assign WHERE "time".assign_id="line_assign".assign_id AND "line_assign".assign_date=\'' . $date_string . '\' ORDER BY "time".time_id ASC');
        //  Time::select('time_id', 'time_name', 'line_id', 'assign_id', 'status', 'div_target', 'div_actual_target', 'div_actual_percent', 'actual_target_entry')->orderBy('time_id', 'asc')->get();

        $getLine = DB::select('SELECT "line".l_id,"line".l_name,"line_assign".assign_id,"line_assign".main_target,"line_assign".s_time,"line_assign".e_time,"line_assign".lunch_s_time,"line_assign".lunch_e_time,"line_assign".assign_date,"users".id,"users".name
        FROM line
        JOIN line_assign ON "line_assign".l_id = "line".l_id
        JOIN users ON "users".id= "line_assign".user_id
        WHERE "line".a_status=1 AND "line_assign".assign_date=\'' . $date_string . '\' ORDER BY "line".l_pos ASC');

        // $top_line = DB::select('SELECT "time".line_id,"line".l_name,SUM("time".div_actual_target) AS total_actual
        // FROM time,line,line_assign WHERE "line_assign".assign_date=\'' . $date_string . '\' AND "time".line_id="line".l_id AND "time".line_id="line_assign".l_id AND div_actual_percent IS NOT NULL GROUP BY
        // "time".line_id,"line".l_name ORDER BY SUM("time".div_actual_target) DESC LIMIT 3');

        DB::disconnect('musung');

        return view(
            'livewire.dash1',
            compact('getLine', 'time', 'time_2'),
            // ['percent_chart' => $percent_chart->build()]
        );
    }
}
