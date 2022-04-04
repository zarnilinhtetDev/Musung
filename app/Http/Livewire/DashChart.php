<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Charts\LiveDashPercentChart;
use Illuminate\Support\Facades\DB;
use App\Models\LineAssign;
use App\Models\Line;

class DashChart extends Component
{
    public function dehydrate()
    {
        $this->dispatchBrowserEvent('initSomethingChart');
    }
    public function render()
    {
        $date_string = date("d.m.Y");

        $line_assign_apex_chart = LineAssign::select('main_target')->orderBy('l_id', 'asc')->where('assign_date', $date_string)->get();

        $line_apex_chart = Line::select('l_name')->where('a_status', 1)->orderBy('l_pos', 'asc')->get();

        $time_apex_chart = DB::select('SELECT SUM("time".div_actual_target) AS total_actual_target FROM time
        JOIN line_assign ON "line_assign".l_id = "time".line_id AND "line_assign".assign_date="time".assign_date AND
        "line_assign".assign_date=\'' . $date_string . '\'
        GROUP BY "time".line_id ORDER BY "time".line_id ASC');

        $top_line = DB::select('SELECT line.l_id,line.l_name,line_assign.main_target AS main_target,SUM(time.div_actual_target) AS total_actual,
        ROUND((SUM(time.div_actual_target)*100/line_assign.main_target),0) AS diff_target_percent,
        ROW_NUMBER() OVER(ORDER BY  ROUND((SUM(time.div_actual_target)*100/line_assign.main_target),0) DESC) AS row_num
        FROM line
        INNER JOIN line_assign ON line_assign.l_id=line.l_id AND "line_assign".assign_date=\'' . $date_string . '\'
        Inner JOIN time ON time.line_id=line_assign.l_id AND time.assign_date=\'' . $date_string . '\'
        WHERE "time".div_actual_target IS NOT NULL
        GROUP BY line.l_id,line.l_name,line_assign.main_target
        ORDER BY diff_target_percent DESC');

        DB::disconnect('musung');
        return view(
            'livewire.dash-chart',
            compact('line_assign_apex_chart', 'line_apex_chart', 'time_apex_chart', 'top_line')
        );
    }
}
