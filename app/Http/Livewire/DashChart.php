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
    public function render(LiveDashPercentChart $percent_chart)
    {
        return view(
            'livewire.dash-chart',
            ['percent_chart' => $percent_chart->build()]
        );
    }
}
