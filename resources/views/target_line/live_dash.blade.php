@extends('layouts.app')
@section('content')
@section('content_2')
<div class="container-fluid">
    @php
    $json_encode = json_encode($responseBody);
    $json_decode = json_decode($json_encode);
    @endphp
    @foreach($json_decode as $d)
    @php
    $line_id = $d->l_id;
    $line_name = $d->l_name;
    $a_id=$d->assign_id;
    $main_target=$d->main_target;
    $s_time = $d->s_time;
    $e_time=$d->e_time;
    $lunch_s_time=$d->lunch_s_time;
    $lunch_e_time=$d->lunch_e_time;
    $time_id=$d->time_id;
    $time_name=$d->time_name;
    $line_status=$d->status;
    $div_target=$d->div_target;
    $actual_target=$d->actual_target_entry;
    $assign_date = $d->assign_date;

    // $date_string = date("d.m.Y");

    @endphp
    @endforeach
    @php $date_string = date("d.m.Y");
    $date_string_for_export_pdf = date("Y_m_d", strtotime($date_string)); @endphp
    <div class="row container-fluid pt-4">
        <div class="col-12 col-md-6 m-auto">
            <ul class="horizontal-slide" style="" id="tabs">
                <li class="span2 bg-transparent">
                    <h2 class="m-0 fw-bold">Date - {{ $date_string }}</h2>
                </li>
            </ul>
        </div>
        <div class="col-12 col-md-6 my-auto text-center text-md-start p-0">
            <div>
                <h2 class="m-0 fw-bold" id="digital-clock-2"></h2>
            </div>
            <script>
                /// Live Clock in line_entry.blade
                function showTime() {
                    var date = new Date().toLocaleTimeString(
                        "en-US",
                        Intl.DateTimeFormat().resolvedOptions().timeZone
                    );

                    document.getElementById("digital-clock-2").innerHTML = date;
                }
                setInterval(showTime, 1000);

                /// Live Clock in line_entry.blade End
            </script>
        </div>
    </div>
    <div id="history_div">
        <div class="row container-fluid p-0 my-3 mx-auto">
            <div class="col-12 col-md-8" id="live_dash_wrapper">
                <livewire:dash1 />
            </div>
            <div class="col-12 col-md-4 p-sm-0 p-md-2 my-sm-2 my-md-0 top-3" id="percent_dash_wrapper">
                <livewire:dash-chart />
            </div>
        </div>
        <div class="container-fluid p-0 my-3">
            <div class="row">
                {{--
                <livewire:dash2 />
                <livewire:dash3 /> --}}
            </div>
        </div>
    </div>
</div>


<script>
    $("#exportPDF").click(function() {

html2canvas($('#live_dash_1')[0], {
    onrendered: function(canvas) {
        var data = canvas.toDataURL();
        var docDefinition = {
            content: [{
                image: data,
                width: 500
            }]
        };
        pdfMake.createPdf(docDefinition).download("<?php echo $date_string_for_export_pdf . '_daily_dash'; ?>.pdf");
    }
});

});
</script>


<script>
    var tableToExcel = (function() {
    var uri = 'data:application/vnd.ms-excel;base64,',
        template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="https://www.w3.org/TR/REC-html40"><head></head><body><table border="1" style="text-align:center;">{table}</table></body></html>',
        base64 = function(s) {
            return window.btoa(unescape(encodeURIComponent(s)))
        },
        format = function(s, c) {
            return s.replace(/{(\w+)}/g, function(m, p) {
                return c[p];
            })
        }
    return function(table, name, filename) {
        if (!table.nodeType) table = document.getElementById(table)
        var ctx = {
            worksheet: name || 'Worksheet',
            table: table.innerHTML
        }

        document.getElementById("dlink").href = uri + base64(format(template, ctx));
        document.getElementById("dlink").download = filename;
        document.getElementById("dlink").target = "_blank";
        document.getElementById("dlink").click();

    }
})();

function download() {
    $(document).find('tfoot').remove();
    var name = document.getElementById("name").innerHTML;
    tableToExcel('live_dash_1', 'Sheet 1', name.replace(/\s+/g, ' ') + '.xls')
    //setTimeout("window.location.reload()",0.0000001);

}
var btn = document.getElementById("btn");
btn.addEventListener("click", download);
</script>
@endsection

@endsection
