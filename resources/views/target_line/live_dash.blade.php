@extends('layouts.app')
@section('content')
@section('content_2')
@viewer

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
    <div class="row container-fluid">
        <div class="col-12 col-md-6">
            <ul class="horizontal-slide" style="" id="tabs">
                <li class="span2 bg-transparent">
                    <input class="icon-btn-one btn my-2" type="submit" value="Date - {{ $date_string }}" />
                </li>
                {{-- <li class="span2 bg-transparent">
                    <a id="dlink" style="display:none;"></a>
                    <div id="name" style="display:none;">
                        <?php //echo $date_string_for_export_pdf . "_live_dash"; ?>
                    </div>
                    <button id="btn" class="icon-btn-one icon-btn-one-2 btn my-2">Export to Excel</button>
                </li>
                <li class="span2 bg-transparent">
                    <button type="button" id="exportPDF" class="icon-btn-one icon-btn-one-2 btn my-2">Export to
                        PDF</button>
                </li> --}}
            </ul>
        </div>
        <div class="col-12 col-md-6 my-auto text-center text-md-start">
            <div id="digital-clock-2" class="p-2 fs-2 fw-bold">
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
    <script>
        $("#exportPDF").click(function() {
            var date = "<?php echo $date_string_for_export_pdf; ?>" + "_production_dashboard";

            var element = document.getElementById('history_div');
            var opt = {
                margin: 0.1,
                filename: date + '.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4',
                    orientation: 'landscape'
                },
                enableLinks: true,
            };

            // New Promise-based usage:
            html2pdf().set(opt).from(element).save();

            // Old monolithic-style usage:
            html2pdf(element, opt);
        });
    </script>

    <script>

    </script>
</div>
@endviewer
@superadmin

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
    <div class="row container-fluid">
        <div class="col-12 col-md-6">
            <ul class="horizontal-slide" style="" id="tabs">
                <li class="span2 bg-transparent">
                    <input class="icon-btn-one btn my-2" type="submit" value="Date - {{ $date_string }}" />
                </li>
                <li class="span2 bg-transparent">
                    <a id="dlink" style="display:none;"></a>
                    <div id="name" style="display:none;">
                        <?php echo $date_string_for_export_pdf . "_live_dash"; ?>
                    </div>
                    <button id="btn" class="icon-btn-one icon-btn-one-2 btn my-2">Export to Excel</button>
                </li>
                <li class="span2 bg-transparent">
                    <button type="button" id="exportPDF" class="icon-btn-one icon-btn-one-2 btn my-2">Export to
                        PDF</button>
                </li>
            </ul>
        </div>
        <div class="col-12 col-md-6 my-auto text-center text-md-start">
            <div id="digital-clock-2" class="p-2 fs-2 fw-bold">
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
    <script>
        $("#exportPDF").click(function() {
            var date = "<?php echo $date_string_for_export_pdf; ?>" + "_production_dashboard";

            var element = document.getElementById('history_div');
            var opt = {
                margin: 0.1,
                filename: date + '.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4',
                    orientation: 'landscape'
                },
                enableLinks: true,
            };

            // New Promise-based usage:
            html2pdf().set(opt).from(element).save();

            // Old monolithic-style usage:
            html2pdf(element, opt);
        });
    </script>

    <script>

    </script>
</div>
@endsuperadmin


@owner

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
    <div class="row container-fluid">
        <div class="col-12 col-md-6">
            <ul class="horizontal-slide" style="" id="tabs">
                <li class="span2 bg-transparent">
                    <input class="icon-btn-one btn my-2" type="submit" value="Date - {{ $date_string }}" />
                </li>
                <li class="span2 bg-transparent">
                    <a id="dlink" style="display:none;"></a>
                    <div id="name" style="display:none;">
                        <?php echo $date_string_for_export_pdf . "_live_dash"; ?>
                    </div>
                    <button id="btn" class="icon-btn-one icon-btn-one-2 btn my-2">Export to Excel</button>
                </li>
                <li class="span2 bg-transparent">
                    <button type="button" id="exportPDF" class="icon-btn-one icon-btn-one-2 btn my-2">Export to
                        PDF</button>
                </li>
            </ul>
        </div>
        <div class="col-12 col-md-6 my-auto text-center text-md-start">
            <div id="digital-clock-2" class="p-2 fs-2 fw-bold">
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
    <script>
        $("#exportPDF").click(function() {
            var date = "<?php echo $date_string_for_export_pdf; ?>" + "_production_dashboard";

            var element = document.getElementById('history_div');
            var opt = {
                margin: 0.1,
                filename: date + '.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4',
                    orientation: 'landscape'
                },
                enableLinks: true,
            };

            // New Promise-based usage:
            html2pdf().set(opt).from(element).save();

            // Old monolithic-style usage:
            html2pdf(element, opt);
        });
    </script>

    <script>

    </script>
</div>
@endowner

@admin
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
    <div class="row container-fluid">
        <div class="col-12 col-md-6">
            <ul class="horizontal-slide" style="" id="tabs">
                <li class="span2 bg-transparent">
                    <input class="icon-btn-one btn my-2" type="submit" value="Date - {{ $date_string }}" />
                </li>
                <li class="span2 bg-transparent">
                    <a id="dlink" style="display:none;"></a>
                    <div id="name" style="display:none;">
                        <?php echo $date_string_for_export_pdf . "_live_dash"; ?>
                    </div>
                    <button id="btn_export" class="icon-btn-one icon-btn-one-2 btn my-2"
                        onclick="download_table_as_csv('live_dash_1');">Export to
                        Excel</button>
                </li>
                <li class="span2 bg-transparent">
                    <button type="button" id="exportPDF" class="icon-btn-one icon-btn-one-2 btn my-2">Export to
                        PDF</button>
                </li>
            </ul>
        </div>
        <div class="col-12 col-md-6 my-auto text-center text-md-start">
            <div id="digital-clock-2" class="p-2 fs-2 fw-bold">
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
    <script>
        $("#exportPDF").click(function() {
            var date = "<?php echo $date_string_for_export_pdf; ?>" + "_production_dashboard";

            var element = document.getElementById('history_div');
            var opt = {
                margin: 0.1,
                filename: date + '.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4',
                    orientation: 'landscape'
                },
                enableLinks: true,
            };

            // New Promise-based usage:
            html2pdf().set(opt).from(element).save();

            // Old monolithic-style usage:
            html2pdf(element, opt);
        });
    </script>

    <script>
        function download_table_as_csv(table_id, separator = ',') {    // Select rows from table_id
            var rows = document.querySelectorAll('table#' + table_id + ' tr');
            // Construct csv
            var csv = [];    for (var i = 0; i < rows.length; i++) {
                var row = [], cols = rows[i].querySelectorAll('td, th');
                for (var j = 0; j < cols.length; j++) {            // Clean innertext to remove multiple spaces and jumpline (break csv)
                     var data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ')            // Escape double-quote with double-double-quote (see https://stackoverflow.com/questions/17808511/properly-escape-a-double-quote-in-csv)
                      data = data.replace(/"/g, '""');            // Push escaped string
                               row.push('"' + data + '"');        }
                               csv.push(row.join(separator));
                             }
                                var csv_string = csv.join('\n');    // Download it
                                 var filename = 'export_' + table_id + '_' + new Date().toLocaleDateString() + '.csv';
                                 var link = document.createElement('a');
                                 link.style.display = 'none';
                                 link.setAttribute('target', '_blank');
                                 link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
                                 link.setAttribute('download', filename);
                                 document.body.appendChild(link);
                                 link.click();
                                 document.body.removeChild(link);
                                }
    </script>

</div>

@endadmin

@operator
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
    <div class="row container-fluid">
        <div class="col-12 col-md-6">
            <ul class="horizontal-slide" style="" id="tabs">
                <li class="span2 bg-transparent">
                    <input class="icon-btn-one btn my-2" type="submit" value="Date - {{ $date_string }}" />
                </li>
                <li class="span2 bg-transparent">
                    <a id="dlink" style="display:none;"></a>
                    <div id="name" style="display:none;">
                        <?php echo $date_string_for_export_pdf . "_live_dash"; ?>
                    </div>
                    <button id="btn" class="icon-btn-one icon-btn-one-2 btn my-2">Export to Excel</button>
                </li>
                <li class="span2 bg-transparent">
                    <button type="button" id="exportPDF" class="icon-btn-one icon-btn-one-2 btn my-2">Export to
                        PDF</button>
                </li>
            </ul>
        </div>
        <div class="col-12 col-md-6 my-auto text-center text-md-start">
            <div id="digital-clock-2" class="p-2 fs-2 fw-bold">
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
    <script>
        $("#exportPDF").click(function() {
            var date = "<?php echo $date_string_for_export_pdf; ?>" + "_production_dashboard";

            var element = document.getElementById('history_div');
            var opt = {
                margin: 0.1,
                filename: date + '.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4',
                    orientation: 'landscape'
                },
                enableLinks: true,
            };

            // New Promise-based usage:
            html2pdf().set(opt).from(element).save();

            // Old monolithic-style usage:
            html2pdf(element, opt);
        });
    </script>

    <script>

    </script>
</div>
@endoperator

@line_manager
<script type="text/javascript">
    window.location = "{{url('line_entry')}}";
</script>
@endline_manager
@endsection

@endsection
