<div wire:poll.1000ms>
    @if($time_apex_chart)
    <h1 class="fw-bold heading-text fs-3 p-0">Target and Output Chart</h1>
    <div>
        <div id="percent_chart"></div>
        <?php
        $arr_decode = json_decode(json_encode($time_apex_chart),true);
        $line_assign_apex_chart_decode = json_decode($line_assign_apex_chart,true);
        $line_apex_chart_decode = json_decode($line_apex_chart, true);

        if($arr_decode){ ?>
        <script>
            window.addEventListener('initSomethingChart', event => {

    var getTheme = localStorage.getItem("style");
        if (getTheme == 'light') {
            var options = {
                chart: {
                    animations: {
                    enabled: false,
                },
                    type: "bar",
                    height: 550,
                    style: {
                        colors: '#263238',
                        fontSize: '12px',
                        fontFamily: 'Helvetica, Arial, sans-serif',
                        fontWeight: 400,
                        cssClass: 'apexcharts-xaxis-label',
                    },
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                    },
                },
                dataLabels: {
                    enabled: true,
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ["transparent"]
                },
                legend: {
                    show: true,
                    labels: {
                        colors: '#263238',
                        useSeriesColors: false,
                    },
                },
                yaxis: {
                    labels: {
                        show: true,
                        style: {
                            colors: '#263238',
                        },
                    },
                },
                fill: {
                    opacity: 1
                }, series: [{
                    name: "Output",
                    data: [<?php foreach($top_line as $top) {
                                $diff_target_percent = $top->diff_target_percent;
                                if ($diff_target_percent == ''){
                                   $diff_target_percent = 0;
                                }

                                echo $diff_target_percent . ',';
                            } ?>],
                }, ], xaxis: {
                    categories: [<?php
                                    for ($z = 0; $z < count($line_apex_chart_decode); $z++) {
                                        echo '"' . $line_apex_chart_decode[$z]['l_name'] . '"' . ',';
                                    } ?>],
                    title: {
                        text: "Target and Output",
                        style: {
                            fontSize: '14px',
                            fontWeight: 'bold',
                            color: '#263238'
                        },
                    },
                    labels: {
                        show: true,
                        style: {
                            colors: '#263238',
                            fontSize: '12px',
                            fontFamily: 'Helvetica, Arial, sans-serif',
                            fontWeight: 400,
                            cssClass: 'apexcharts-xaxis-label',
                        },
                    },
                },
            };

            var chart = new ApexCharts(document.querySelector("#percent_chart"), options);

            chart.render();
        }
        if(getTheme=='dark'){
            var options = {
                chart: {
                    animations: {
                    enabled: false,
                },
                    type: "bar",
                    height: 550,
                    style: {
                        colors: '#fff',
                        fontSize: '12px',
                        fontFamily: 'Helvetica, Arial, sans-serif',
                        fontWeight: 400,
                        cssClass: 'apexcharts-xaxis-label',
                    },
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                    },
                },
                dataLabels: {
                    enabled: true,
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ["transparent"]
                },
                legend: {
                    show: true,
                    labels: {
                        colors: '#fff',
                        useSeriesColors: false,
                    },
                },
                yaxis: {
                    labels: {
                        show: true,
                        style: {
                            colors: '#fff',
                        },
                    },
                },
                fill: {
                    opacity: 1
                }, series: [{
                    name: "Output",
                    data: [<?php for ($i = 0; $i < count($arr_decode); $i++) {
                                $total_actual_target = $arr_decode[$i]['total_actual_target'];
                                if ($arr_decode[$i]['total_actual_target'] == ''){
                                   $total_actual_target = 0;
                                }

                                echo $total_actual_target . ',';
                            } ?>]
                }, {
                    name: "Target",
                    data: [<?php for ($j = 0; $j < count($line_assign_apex_chart_decode); $j++) {
                                echo $line_assign_apex_chart_decode[$j]['main_target'] . ',';
                            } ?>]
                }, ], xaxis: {
                    categories: [<?php
                                    for ($z = 0; $z < count($line_apex_chart_decode); $z++) {
                                        echo '"' . $line_apex_chart_decode[$z]['l_name'] . '"' . ',';
                                    } ?>],
                    title: {
                        text: "Target and Output",
                        style: {
                            fontSize: '14px',
                            fontWeight: 'bold',
                            color: '#fff'
                        },
                    },
                    labels: {
                        show: true,
                        style: {
                            colors: '#fff',
                            fontSize: '12px',
                            fontFamily: 'Helvetica, Arial, sans-serif',
                            fontWeight: 400,
                            cssClass: 'apexcharts-xaxis-label',
                        },
                    },
                },   tooltip: {
                    theme: 'dark'
                },
            };

            var chart = new ApexCharts(document.querySelector("#percent_chart"), options);

            chart.render();
        }
        if(getTheme=='gray'){
            var options = {
                                        series: [{
                    name: "Output",
                    data: [<?php for ($i = 0; $i < count($arr_decode); $i++) {
                                $total_actual_target = $arr_decode[$i]['total_actual_target'];
                                if ($arr_decode[$i]['total_actual_target'] == ''){
                                   $total_actual_target = 0;
                                }

                                echo $total_actual_target . ',';
                            } ?>]
                }, {
                    name: "Target",
                    data: [<?php for ($j = 0; $j < count($line_assign_apex_chart_decode); $j++) {
                                echo $line_assign_apex_chart_decode[$j]['main_target'] . ',';
                            } ?>]
                }, ],
                chart: {
                    animations: {
                    enabled: false,
                },
                    type: "bar",
                    height: 550,
                    style: {
                        colors: '#263238',
                        fontSize: '12px',
                        fontFamily: 'Helvetica, Arial, sans-serif',
                        fontWeight: 400,
                        cssClass: 'apexcharts-xaxis-label',
                    },
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                    },
                },
                dataLabels: {
                    enabled: true,
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ["transparent"]
                },
                legend: {
                    show: true,
                    labels: {
                        colors: '#fff',
                        useSeriesColors: false,
                    },
                },
                xaxis: {
                    categories: [<?php $line_apex_chart_decode = json_decode($line_apex_chart, true);
                                    for ($z = 0; $z < count($line_apex_chart_decode); $z++) {
                                        echo '"' . $line_apex_chart_decode[$z]['l_name'] . '"' . ',';
                                    } ?>],
                    title: {
                        text: "Target and Output",
                        style: {
                            fontSize: '14px',
                            fontWeight: 'bold',
                            color: '#fff'
                        },
                    },
                    labels: {
                        show: true,
                        style: {
                            colors: '#fff',
                            fontSize: '12px',
                            fontFamily: 'Helvetica, Arial, sans-serif',
                            fontWeight: 400,
                            cssClass: 'apexcharts-xaxis-label',
                        },
                    },
                },
                yaxis: {
                    labels: {
                        show: true,
                        style: {
                            colors: '#fff',
                        },
                    },
                },
                tooltip: {
                    theme: 'dark'
                },
                fill: {
                    opacity: 1
                },
            };

            var chart = new ApexCharts(document.querySelector("#percent_chart"), options);

            chart.render();
        }
});
        </script>
        <?php }
        ?>

    </div>
    @endif
</div>
