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
        $top_line = DB::select('SELECT "time".line_id,"line".l_name,SUM("time".div_actual_target) AS total_actual
        FROM time,line,line_assign WHERE "line_assign".assign_date=\'' . $date_string . '\' AND "time".line_id="line".l_id AND "time".line_id="line_assign".l_id AND div_actual_percent IS NOT NULL GROUP BY
        "time".line_id,"line".l_name ORDER BY SUM("time".div_actual_target) DESC LIMIT 3');

        DB::disconnect('musung');

        return view('livewire.dash3', compact('top_line'),);
    }
}
