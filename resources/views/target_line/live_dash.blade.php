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
    <div class="row container-fluid">
        <div class="col-12 col-md-6">
            <ul class="horizontal-slide" style="" id="tabs">
                <li class="span2 bg-transparent">
                    <input class="icon-btn-one btn my-2" type="submit" value="Date - {{ $date_string }}" />
                </li>
                <li class="span2 bg-transparent">
                    <input class="icon-btn-one icon-btn-one-2 btn my-2" type="submit" value="Export to Excel"
                        name="submit" />
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
            <livewire:dash1 />
            <div class="col-12 col-md-4 p-sm-0 p-md-2 my-sm-2 my-md-0 top-3">
                <livewire:dash-chart />
            </div>
        </div>
        <div class="container-fluid p-0 my-3">
            <div class="row">
                <livewire:dash2 />
                <livewire:dash3 />
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
</div>
@endsection

@endsection
