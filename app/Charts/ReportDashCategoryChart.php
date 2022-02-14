<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class ReportDashCategoryChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $category = DB::select('SELECT p_cat_id,COUNT(p_cat_id) AS t_cat_id,p_name FROM p_detail
        WHERE DATE(created_at) >= DATE(NOW()) - INTERVAL \'30\' DAY
		GROUP BY p_cat_id,p_name
');

        $category_decode = json_decode(json_encode($category), true);

        $t_cat_id_arr = [];
        $cat_name_arr = [];

        for ($i = 0; $i < count($category_decode); $i++) {
            $t_cat_id = $category_decode[$i]['t_cat_id'];
            $t_cat_id_arr[] = $t_cat_id;
        }
        for ($j = 0; $j < count($category_decode); $j++) {
            $cat_name = $category_decode[$j]['p_name'];
            $cat_name_arr[] = $cat_name;
        }

        return $this->chart->pieChart()
            ->setTitle('Production Report of Categories for 30 days')
            ->addData($t_cat_id_arr)
            ->setLabels($cat_name_arr);
    }
}
