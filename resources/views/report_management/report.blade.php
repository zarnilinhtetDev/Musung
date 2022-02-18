@extends('layouts.app')

@section('content')

@section('content_2')

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

</script>
@endsection

@endsection
