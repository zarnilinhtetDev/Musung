<?php

namespace App\Http\Livewire;

use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Livewire\Component;
use App\Models\LineAssign;
use App\Models\Line;
use Illuminate\Support\Facades\DB;

class LiveWire extends Component
{
    public $colors = [
        'food' => '#f6ad55',
        'shopping' => '#fc8181',
        'entertainment' => '#90cdf4',
        'travel' => '#66DA26',
        'other' => '#cbd5e0',
    ];
    public $firstRun = true;
    public $types = ['food', 'shopping', 'entertainment', 'travel', 'other'];

    public function render()
    {
        $date_string = date("d.m.Y");
        // $line_assign = LineAssign::select('main_target')->orderBy('l_id', 'asc')->where('assign_date', $date_string)->pluck('main_target')->toArray();
        $line_assign = LineAssign::select('main_target')->orderBy('l_id', 'asc')->where('assign_date', $date_string)->get();
        $line = Line::select('l_name')->where('a_status', 1)->orderBy('l_pos', 'asc')->get();
        $time = DB::select('SELECT SUM("time".div_actual_target) AS total_actual_target FROM time JOIN line_assign ON "line_assign".l_id = "time".line_id AND "line_assign".assign_date= \'' . $date_string . '\' GROUP BY "time".line_id ORDER BY "time".line_id ASC');

        $arr_decode = json_decode(json_encode($time), true);
        $arr = [];
        for ($i = 0; $i < count($arr_decode); $i++) {
            $total_actual_target = $arr_decode[$i]['total_actual_target'];
            $arr[] = $total_actual_target;
        }

        $columnChartModel = $line
            ->reduce(
                function ($columnChartModel, $data) {
                    $type = $data->l_name;
                    // $value = $data->l_name;

                    return $columnChartModel
                        ->addColumn($type, 100, '#f6ad55');
                },
                LivewireCharts::columnChartModel()
                    ->setTitle('Expenses by Type')
                    ->setAnimated($this->firstRun)
                    ->setLegendVisibility(false)
                    //->setOpacity(0.25)
                    ->addColumn($line, 100, '#f6ad55')
                    // ->setColors(['#b01a1b', '#d41b2c', '#ec3c3b', '#f66665'])
                    ->setColumnWidth(90)
                    ->withGrid()
                    ->setHorizontal(true)
            );
        $this->firstRun = false;

        return view('livewire.live-wire')->with([
            'columnChartModel' => $columnChartModel,
        ]);
    }
}
