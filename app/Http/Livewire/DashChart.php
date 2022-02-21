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

        DB::disconnect('musung');
        return view(
            'livewire.dash-chart',
            compact('line_assign_apex_chart', 'line_apex_chart', 'time_apex_chart')
        );
    }
}
