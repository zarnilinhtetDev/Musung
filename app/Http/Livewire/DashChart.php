<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Charts\LiveDashPercentChart;

class DashChart extends Component
{
    public function render(LiveDashPercentChart $percent_chart)
    {
        return view(
            'livewire.dash-chart',
            ['percent_chart' => $percent_chart->build()]
        );
    }
}
