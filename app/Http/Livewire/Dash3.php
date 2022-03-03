<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Dash3 extends Component
{
    public function dehydrate()
    {
        $this->dispatchBrowserEvent('initSomething3');
    }
    public function render()
    {
        $date_string = date("d.m.Y");
        $u_id = Auth::user()->id;
        $top_line = DB::select('SELECT line.l_id,line.l_name,line_assign.main_target AS main_target,SUM(time.div_actual_target) AS total_actual,
        ROUND((SUM(time.div_actual_target)*100/line_assign.main_target),1) AS diff_target_percent
        FROM line
        INNER JOIN line_assign ON line_assign.l_id=line.l_id AND "line_assign".assign_date=\'' . $date_string . '\'
        Inner JOIN time ON time.line_id=line_assign.l_id AND time.assign_date=\'' . $date_string . '\'
        GROUP BY line.l_id,line.l_name,line_assign.main_target
        ORDER BY diff_target_percent DESC
        LIMIT 3');

        $last_line = DB::select('SELECT line.l_id,line.l_name,line_assign.main_target AS main_target,SUM(time.div_actual_target) AS total_actual,
        ROUND((SUM(time.div_actual_target)*100/line_assign.main_target),1) AS diff_target_percent
        FROM line
        INNER JOIN line_assign ON line_assign.l_id=line.l_id AND "line_assign".assign_date=\'' . $date_string . '\'
        Inner JOIN time ON time.line_id=line_assign.l_id AND time.assign_date=\'' . $date_string . '\'
        GROUP BY line.l_id,line.l_name,line_assign.main_target
        ORDER BY diff_target_percent ASC
        LIMIT 1');

        DB::disconnect('musung');

        return view('livewire.dash3', compact('top_line', 'last_line'),);
    }
}
