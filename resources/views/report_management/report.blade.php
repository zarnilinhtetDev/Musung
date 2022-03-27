@extends('layouts.app')

@section('content')

@section('content_2')

<?php
$date_string = date("d.m.Y");
?>

@admin

<div class="container-fluid">
    <div class="col-12 col-md-4 my-3 p-0">
        <ul class="horizontal-slide" id="tabs">
            <li class="span2">
                <p>Date - {{ $date_string }} </p>
            </li>
        </ul>
    </div>

    <?php
    $daily_report_decode = json_decode(json_encode($daily_report),true);
    $daily_report_product_decode = json_decode(json_encode($daily_report_product),true);
    ?>

    <div style="overflow: auto;max-width:100%;max-height:600px;">
        <table class="table table-striped my-4 tableFixHead results p-0 text-center">
            <thead>
                <tr class="tr-2">
                    <th scope="col">Line</th>
                    <th scope="col">Style no.</th>
                    <th scope="col">Target</th>
                    <th scope="col">Output</th>
                    <th scope="col">%</th>
                    <th scope="col">Q'ty</th>
                    <th scope="col">Input</th>
                    <th scope="col">Total</th>
                    <th scope="col">Output</th>
                    <th scope="col">Total</th>
                    <th scope="col">Inline</th>
                    <th scope="col">H/over</th>
                    <th scope="col">Total</th>
                    <th scope="col">H/over balance</th>
                    <th scope="col">
                        <table class="table table-borderless text-white m-0">
                            <thead>
                                <th class="p-0" scope="col">S,L,Adm Op</th>
                                <th class="p-0" scope="col">Hp</th>
                            </thead>
                        </table>
                    </th>
                </tr>
            </thead>
            <tbody id="myTable">
                @for($i=0;$i<count($daily_report_decode);$i++) @php
                    $l_id=$daily_report_decode[$i]['l_id'];$l_name=$daily_report_decode[$i]['l_name'];$main_target=$daily_report_decode[$i]['main_target'];$actual_target=$daily_report_decode[$i]['total_div_actual_target'];
                    $m_power=$daily_report_decode[$i]['m_power'];$actual_m_power=$daily_report_decode[$i]['actual_m_power'];$hp=$daily_report_decode[$i]['hp'];$actual_hp=$daily_report_decode[$i]['actual_hp'];
                    @endphp <tr>
                    <td>{{ $l_name }}</td>
                    <td>
                        <table class="m-auto text-start">
                            <tbody>
                                <tr class="bg-warning text-white">
                                    <td><span>Overall Target</span></td>
                                </tr>
                                @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                    $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                    $p_name=$daily_report_product_decode[$j]['p_name'] @endphp @if($l_id_2==$l_id) <tr>
                                    <td>{{ $p_name }}</td>
                                    </tr>
                                    @endif

                                    @endfor

                            </tbody>
                        </table>
                    </td>
                    <td>{{ $main_target }}</td>
                    <td>{{ $actual_target }}</td>
                    <td class="text-danger">need_to_fill</td>
                    <td class="text-danger">need_to_fill</td>

                    <!-- Sewing Input --->
                    <td>
                        <table class="m-auto text-center">
                            <tbody>
                                <tr>
                                    <td>-</td>
                                </tr>
                                @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                    $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                    $sewing_input=$daily_report_product_decode[$j]['sewing_input'] @endphp
                                    @if($l_id_2==$l_id) <tr>
                                    <td>{{ $sewing_input }}</td>
                                    </tr>
                                    @endif

                                    @endfor

                            </tbody>
                        </table>
                    </td>

                    <td class="text-danger">need_to_fill</td>

                    <!-- Clothes Input --->
                    <td>
                        <table class="m-auto text-center">
                            <tbody>
                                <tr>
                                    <td>-</td>
                                </tr>
                                @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                    $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                    $cat_actual_target=$daily_report_product_decode[$j]['cat_actual_target'] @endphp
                                    @if($l_id_2==$l_id) <tr>
                                    <td>{{ $cat_actual_target }}</td>
                                    </tr>
                                    @endif

                                    @endfor

                            </tbody>
                        </table>
                    </td>

                    <td class="text-danger">need_to_fill</td>
                    <td class="text-danger">need_to_fill</td>

                    <!-- H/over Input --->
                    <td>
                        <table class="m-auto text-center">
                            <tbody>
                                <tr>
                                    <td>-</td>
                                </tr>
                                @for($j=0;$j<count($daily_report_product_decode);$j++) @php
                                    $l_id_2=$daily_report_product_decode[$j]['l_id'];
                                    $h_over_input=$daily_report_product_decode[$j]['h_over_input'] @endphp
                                    @if($l_id_2==$l_id) <tr>
                                    <td>{{ $h_over_input }}</td>
                                    </tr>
                                    @endif

                                    @endfor

                            </tbody>
                        </table>
                    </td>
                    <td class="text-danger">need_to_fill</td>
                    <td class="text-danger">need_to_fill</td>
                    <td>
                        <table class="m-auto text-center w-100">
                            <tbody>
                                <tr>
                                    <td class="m_power_value_{{ $l_id }}">{{ $m_power }}</td>
                                    <td class="hp_value_{{ $l_id }}">{{ $hp }}</td>
                                </tr>
                                <tr>
                                    <td class="total_m_power_{{ $l_id }}" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="actual_m_power_value_{{ $l_id }}">{{ $actual_m_power }}</td>
                                    <td class="actual_hp_value_{{ $l_id }}">{{ $actual_hp }}</td>
                                </tr>
                                <tr>
                                    <td class="total_actual_m_power_{{ $l_id }}" colspan="2"></td>
                                </tr>
                            </tbody>
                        </table>

                        <script>
                            var m_power_value = parseInt($('.m_power_value_{{ $l_id }}').text());
                            var hp_value = parseInt($('.hp_value_{{ $l_id }}').text());
                            var actual_m_power = parseInt($('.actual_m_power_value_{{ $l_id }}').text());
                            var actual_hp_value = parseInt($('.actual_hp_value_{{ $l_id }}').text());

                            var total_m_power_value = $('.total_m_power_{{ $l_id }}');
                            var total_actual_m_power_value = $('.total_actual_m_power_{{ $l_id }}');

                            var total_m_power = m_power_value + hp_value;
                            var total_actual_m_power = actual_m_power + actual_hp_value;

                            if(Number.isNaN(total_m_power)){
                            total_m_power_value.text('');
                            total_actual_m_power_value.text('');
                            }
                            else{
                            total_m_power_value.text(total_m_power);
                            total_actual_m_power_value.text(total_actual_m_power);
                            }

                        </script>
                    </td>
                    </tr>
                    @endfor </tbody>
        </table>
    </div>
</div>
<div class="row container-fluid">
    <div class="col-12 col-md-6 my-4 rounded shadow" id="production_chart">
    </div>
    <div class="col-12 col-md-6 my-auto" id="product_chart">
    </div>
</div>
<script>
    let getTheme = localStorage.getItem("style");
</script>

<script>
    if(getTheme=='light'){
        var options = {
    series: [{
    name: 'Target',
    data: [
    @foreach($target as $t)
    @php
    $t_main_target = $t->t_main_target;
    echo $t_main_target . ',';
    @endphp
    @endforeach]
    }, {
    name: 'Actual Target',
    data: [@foreach($time as $t)
@php
$t_div_actual_target = $t->t_actual_target;
echo $t_div_actual_target . ',';
@endphp
@endforeach]
    }],
    title: {
    text: 'Production Report of last 30 days',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  'Arial',
      color:  '#263238'
    },
},
    chart: {
    height: 350,
    type: 'area',
    toolbar: {
    show: true
},
    },
legend: {
      labels: {
          colors: ['#263238'],
          useSeriesColors: false
      },
    },
    dataLabels: {
    enabled: true,
    },
    stroke: {
    curve: 'smooth'
    },
    xaxis: {
    categories: [
    @foreach($target as $t_2)
    @php
    $assign_date = $t_2->assign_date;
    $month = date('m', strtotime($assign_date)); // Create date object to store the DateTime format
    $day = date('d', strtotime($assign_date));
    $dateObj = DateTime::createFromFormat('!m', $month);

    // Store the month name to variable
    $monthName = $dateObj->format('F');
    $full_format = $day . ' ' . $monthName;

    echo '"' . $full_format . '"' . ',';;
    @endphp
    @endforeach],
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
    yaxis:{
    labels: {
          show: true,
          style:{
              colors:'#263238',
          },
    },
    },
    tooltip: {
    theme: 'dark'
  },
    };

    var chart = new ApexCharts(document.querySelector("#production_chart"), options);
    chart.render();
    }

    if(getTheme=='dark'){
        var options = {
    series: [{
    name: 'Target',
    data: [
    @foreach($target as $t)
    @php
    $t_main_target = $t->t_main_target;
    echo $t_main_target . ',';
    @endphp
    @endforeach]
    }, {
    name: 'Actual Target',
    data: [@foreach($time as $t)
@php
$t_div_actual_target = $t->t_actual_target;
echo $t_div_actual_target . ',';
@endphp
@endforeach]
    }],
    title: {
    text: 'Production Report of last 30 days',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  'Arial',
      color:  '#fff'
    },
},
    chart: {
    height: 350,
    type: 'area',
    toolbar: {
    show: true
},
    },
legend: {
      labels: {
          colors: ['#fff'],
          useSeriesColors: false
      },
    },
    dataLabels: {
    enabled: true,
    },
    stroke: {
    curve: 'smooth'
    },
    xaxis: {
    categories: [
    @foreach($target as $t_2)
    @php
    $assign_date = $t_2->assign_date;
    $month = date('m', strtotime($assign_date)); // Create date object to store the DateTime format
    $day = date('d', strtotime($assign_date));
    $dateObj = DateTime::createFromFormat('!m', $month);

    // Store the month name to variable
    $monthName = $dateObj->format('F');
    $full_format = $day . ' ' . $monthName;

    echo '"' . $full_format . '"' . ',';;
    @endphp
    @endforeach],
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
    yaxis:{
    labels: {
          show: true,
          style:{
              colors:'#fff',
          },
    },
    },
    tooltip: {
    theme: 'dark'
  },
    };

    var chart = new ApexCharts(document.querySelector("#production_chart"), options);
    chart.render();
    }

    if(getTheme=='gray'){
        var options = {
    series: [{
    name: 'Target',
    data: [
    @foreach($target as $t)
    @php
    $t_main_target = $t->t_main_target;
    echo $t_main_target . ',';
    @endphp
    @endforeach]
    }, {
    name: 'Actual Target',
    data: [@foreach($time as $t)
@php
$t_div_actual_target = $t->t_actual_target;
echo $t_div_actual_target . ',';
@endphp
@endforeach]
    }],
    title: {
    text: 'Production Report of last 30 days',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  'Arial',
      color:  '#fff'
    },
},
    chart: {
    height: 350,
    type: 'area',
    toolbar: {
    show: true
},
    },
legend: {
      labels: {
          colors: ['#fff'],
          useSeriesColors: false
      },
    },
    dataLabels: {
    enabled: true,
    },
    stroke: {
    curve: 'smooth'
    },
    xaxis: {
    categories: [
    @foreach($target as $t_2)
    @php
    $assign_date = $t_2->assign_date;
    $month = date('m', strtotime($assign_date)); // Create date object to store the DateTime format
    $day = date('d', strtotime($assign_date));
    $dateObj = DateTime::createFromFormat('!m', $month);

    // Store the month name to variable
    $monthName = $dateObj->format('F');
    $full_format = $day . ' ' . $monthName;

    echo '"' . $full_format . '"' . ',';;
    @endphp
    @endforeach],
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
    yaxis:{
    labels: {
          show: true,
          style:{
              colors:'#fff',
          },
    },
    },
    tooltip: {
    theme: 'dark'
  },
    };

    var chart = new ApexCharts(document.querySelector("#production_chart"), options);
    chart.render();
    }
</script>

<script>
    if(getTheme=='dark'){
        var options = {
  series: [@foreach($category as $c)
@php
$cat_actual = $c->t_cat_actual;
if($cat_actual == ''){
$cat_actual = 0;
}
if($cat_actual!=''){
$cat_actual = $cat_actual;
}
echo $cat_actual . ',';
@endphp
@endforeach],
  chart: {
      width:'100%',
      height:'80%',
      type: 'pie',
      toolbar: {
    show: true,
},
},title: {
    text: 'Production Report of Categories for 30 days',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  'Arial',
      color:  '#fff'
    },
},
legend: {
      position: 'right',
      labels: {
          colors: ['#fff'],
          useSeriesColors: false
      },
    },
labels: [
@foreach($category as $c)
@php
$p_name = $c->p_name;
echo '"' . $p_name . '"' . ',';
@endphp
@endforeach],
responsive: [{
  breakpoint: 480,
  options: {
    chart: {
    //   width: 200
    },
    legend: {
      position: 'bottom'
    },
  }
}]
};

var chart = new ApexCharts(document.querySelector("#product_chart"), options);
chart.render();
    }

    if(getTheme=='light'){
        var options = {
  series: [@foreach($category as $c)
@php
$cat_actual = $c->t_cat_actual;
if($cat_actual == ''){
$cat_actual = 0;
}
if($cat_actual!=''){
$cat_actual = $cat_actual;
}
echo $cat_actual . ',';
@endphp
@endforeach],
  chart: {
      width:'100%',
      height:'80%',
    //   background: '#fff',
      type: 'pie',
      toolbar: {
    show: true,
},
},title: {
    text: 'Production Report of Categories for 30 days',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  'Arial',
      color: '#263238'
    },
},
legend: {
      position: 'right',
    //   labels: {
    //       colors: ['#fff'],
    //       useSeriesColors: false
    //   },
    },
labels: [
@foreach($category as $c)
@php
$p_name = $c->p_name;
echo '"' . $p_name . '"' . ',';
@endphp
@endforeach],
responsive: [{
  breakpoint: 480,
  options: {
    chart: {
    //   width: 200
    },
    legend: {
      position: 'bottom'
    },
  }
}]
};

var chart = new ApexCharts(document.querySelector("#product_chart"), options);
chart.render();
    }

    if(getTheme=='gray'){
        var options = {
  series: [@foreach($category as $c)
@php
$cat_actual = $c->t_cat_actual;
if($cat_actual == ''){
$cat_actual = 0;
}
if($cat_actual!=''){
$cat_actual = $cat_actual;
}
echo $cat_actual . ',';
@endphp
@endforeach],
  chart: {
      width:'100%',
      height:'80%',
      type: 'pie',
      toolbar: {
    show: true,
},
},title: {
    text: 'Production Report of Categories for 30 days',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  'Arial',
      color:  '#fff'
    },
},
legend: {
      position: 'right',
      labels: {
          colors: ['#fff'],
          useSeriesColors: false
      },
    },
labels: [
@foreach($category as $c)
@php
$p_name = $c->p_name;
echo '"' . $p_name . '"' . ',';
@endphp
@endforeach],
responsive: [{
  breakpoint: 480,
  options: {
    chart: {
    //   width: 200
    },
    legend: {
      position: 'bottom'
    },tooltip: {
    theme: 'dark'
  },
  }
}]
};

var chart = new ApexCharts(document.querySelector("#product_chart"), options);
chart.render();
    }

</script>

@endadmin

@operator

<div class="row container-fluid">
    <div class="col-12 col-md-6 my-4 rounded shadow" id="production_chart">
    </div>
    <div class="col-12 col-md-6 my-auto" id="product_chart">
    </div>
</div>
<script>
    let getTheme = localStorage.getItem("style");
</script>

<script>
    if(getTheme=='light'){
        var options = {
    series: [{
    name: 'Target',
    data: [
    @foreach($target as $t)
    @php
    $t_main_target = $t->t_main_target;
    echo $t_main_target . ',';
    @endphp
    @endforeach]
    }, {
    name: 'Actual Target',
    data: [@foreach($time as $t)
@php
$t_div_actual_target = $t->t_actual_target;
echo $t_div_actual_target . ',';
@endphp
@endforeach]
    }],
    title: {
    text: 'Production Report of last 30 days',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  'Arial',
      color:  '#263238'
    },
},
    chart: {
    height: 350,
    type: 'area',
    toolbar: {
    show: true
},
    },
legend: {
      labels: {
          colors: ['#263238'],
          useSeriesColors: false
      },
    },
    dataLabels: {
    enabled: true,
    },
    stroke: {
    curve: 'smooth'
    },
    xaxis: {
    categories: [
    @foreach($target as $t_2)
    @php
    $assign_date = $t_2->assign_date;
    $month = date('m', strtotime($assign_date)); // Create date object to store the DateTime format
    $day = date('d', strtotime($assign_date));
    $dateObj = DateTime::createFromFormat('!m', $month);

    // Store the month name to variable
    $monthName = $dateObj->format('F');
    $full_format = $day . ' ' . $monthName;

    echo '"' . $full_format . '"' . ',';;
    @endphp
    @endforeach],
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
    yaxis:{
    labels: {
          show: true,
          style:{
              colors:'#263238',
          },
    },
    },
    tooltip: {
    theme: 'dark'
  },
    };

    var chart = new ApexCharts(document.querySelector("#production_chart"), options);
    chart.render();
    }

    if(getTheme=='dark'){
        var options = {
    series: [{
    name: 'Target',
    data: [
    @foreach($target as $t)
    @php
    $t_main_target = $t->t_main_target;
    echo $t_main_target . ',';
    @endphp
    @endforeach]
    }, {
    name: 'Actual Target',
    data: [@foreach($time as $t)
@php
$t_div_actual_target = $t->t_actual_target;
echo $t_div_actual_target . ',';
@endphp
@endforeach]
    }],
    title: {
    text: 'Production Report of last 30 days',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  'Arial',
      color:  '#fff'
    },
},
    chart: {
    height: 350,
    type: 'area',
    toolbar: {
    show: true
},
    },
legend: {
      labels: {
          colors: ['#fff'],
          useSeriesColors: false
      },
    },
    dataLabels: {
    enabled: true,
    },
    stroke: {
    curve: 'smooth'
    },
    xaxis: {
    categories: [
    @foreach($target as $t_2)
    @php
    $assign_date = $t_2->assign_date;
    $month = date('m', strtotime($assign_date)); // Create date object to store the DateTime format
    $day = date('d', strtotime($assign_date));
    $dateObj = DateTime::createFromFormat('!m', $month);

    // Store the month name to variable
    $monthName = $dateObj->format('F');
    $full_format = $day . ' ' . $monthName;

    echo '"' . $full_format . '"' . ',';;
    @endphp
    @endforeach],
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
    yaxis:{
    labels: {
          show: true,
          style:{
              colors:'#fff',
          },
    },
    },
    tooltip: {
    theme: 'dark'
  },
    };

    var chart = new ApexCharts(document.querySelector("#production_chart"), options);
    chart.render();
    }

    if(getTheme=='gray'){
        var options = {
    series: [{
    name: 'Target',
    data: [
    @foreach($target as $t)
    @php
    $t_main_target = $t->t_main_target;
    echo $t_main_target . ',';
    @endphp
    @endforeach]
    }, {
    name: 'Actual Target',
    data: [@foreach($time as $t)
@php
$t_div_actual_target = $t->t_actual_target;
echo $t_div_actual_target . ',';
@endphp
@endforeach]
    }],
    title: {
    text: 'Production Report of last 30 days',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  'Arial',
      color:  '#fff'
    },
},
    chart: {
    height: 350,
    type: 'area',
    toolbar: {
    show: true
},
    },
legend: {
      labels: {
          colors: ['#fff'],
          useSeriesColors: false
      },
    },
    dataLabels: {
    enabled: true,
    },
    stroke: {
    curve: 'smooth'
    },
    xaxis: {
    categories: [
    @foreach($target as $t_2)
    @php
    $assign_date = $t_2->assign_date;
    $month = date('m', strtotime($assign_date)); // Create date object to store the DateTime format
    $day = date('d', strtotime($assign_date));
    $dateObj = DateTime::createFromFormat('!m', $month);

    // Store the month name to variable
    $monthName = $dateObj->format('F');
    $full_format = $day . ' ' . $monthName;

    echo '"' . $full_format . '"' . ',';;
    @endphp
    @endforeach],
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
    yaxis:{
    labels: {
          show: true,
          style:{
              colors:'#fff',
          },
    },
    },
    tooltip: {
    theme: 'dark'
  },
    };

    var chart = new ApexCharts(document.querySelector("#production_chart"), options);
    chart.render();
    }
</script>

<script>
    if(getTheme=='dark'){
        var options = {
  series: [@foreach($category as $c)
@php
$cat_actual = $c->t_cat_actual;
if($cat_actual == ''){
$cat_actual = 0;
}
if($cat_actual!=''){
$cat_actual = $cat_actual;
}
echo $cat_actual . ',';
@endphp
@endforeach],
  chart: {
      width:'100%',
      height:'80%',
      type: 'pie',
      toolbar: {
    show: true,
},
},title: {
    text: 'Production Report of Categories for 30 days',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  'Arial',
      color:  '#fff'
    },
},
legend: {
      position: 'right',
      labels: {
          colors: ['#fff'],
          useSeriesColors: false
      },
    },
labels: [
@foreach($category as $c)
@php
$p_name = $c->p_name;
echo '"' . $p_name . '"' . ',';
@endphp
@endforeach],
responsive: [{
  breakpoint: 480,
  options: {
    chart: {
    //   width: 200
    },
    legend: {
      position: 'bottom'
    },
  }
}]
};

var chart = new ApexCharts(document.querySelector("#product_chart"), options);
chart.render();
    }

    if(getTheme=='light'){
        var options = {
  series: [@foreach($category as $c)
@php
$cat_actual = $c->t_cat_actual;
if($cat_actual == ''){
$cat_actual = 0;
}
if($cat_actual!=''){
$cat_actual = $cat_actual;
}
echo $cat_actual . ',';
@endphp
@endforeach],
  chart: {
      width:'100%',
      height:'80%',
    //   background: '#fff',
      type: 'pie',
      toolbar: {
    show: true,
},
},title: {
    text: 'Production Report of Categories for 30 days',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  'Arial',
      color: '#263238'
    },
},
legend: {
      position: 'right',
    //   labels: {
    //       colors: ['#fff'],
    //       useSeriesColors: false
    //   },
    },
labels: [
@foreach($category as $c)
@php
$p_name = $c->p_name;
echo '"' . $p_name . '"' . ',';
@endphp
@endforeach],
responsive: [{
  breakpoint: 480,
  options: {
    chart: {
    //   width: 200
    },
    legend: {
      position: 'bottom'
    },
  }
}]
};

var chart = new ApexCharts(document.querySelector("#product_chart"), options);
chart.render();
    }

    if(getTheme=='gray'){
        var options = {
  series: [@foreach($category as $c)
@php
$cat_actual = $c->t_cat_actual;
if($cat_actual == ''){
$cat_actual = 0;
}
if($cat_actual!=''){
$cat_actual = $cat_actual;
}
echo $cat_actual . ',';
@endphp
@endforeach],
  chart: {
      width:'100%',
      height:'80%',
      type: 'pie',
      toolbar: {
    show: true,
},
},title: {
    text: 'Production Report of Categories for 30 days',
    align: 'left',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  'Arial',
      color:  '#fff'
    },
},
legend: {
      position: 'right',
      labels: {
          colors: ['#fff'],
          useSeriesColors: false
      },
    },
labels: [
@foreach($category as $c)
@php
$p_name = $c->p_name;
echo '"' . $p_name . '"' . ',';
@endphp
@endforeach],
responsive: [{
  breakpoint: 480,
  options: {
    chart: {
    //   width: 200
    },
    legend: {
      position: 'bottom'
    },tooltip: {
    theme: 'dark'
  },
  }
}]
};

var chart = new ApexCharts(document.querySelector("#product_chart"), options);
chart.render();
    }

</script>
@endoperator

@line_manager
<script type="text/javascript">
    window.location = "{{url('line_entry')}}";
</script>
@endline_manager
@endsection

@endsection
