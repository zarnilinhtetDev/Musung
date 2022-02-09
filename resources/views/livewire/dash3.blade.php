<div class="col-12 col-md-4 p-sm-0 p-md-auto my-sm-2 my-md-0 top-3" wire:poll.1000ms>
    <div class="div-bg-1">
        <h1 class="fw-bold heading-text fs-3 p-2">Top 3 Lines and Last Line Data</h1>
        <div class="panel-body">
            <table class="table table-hover table-striped table-bordered text-center">
                <tbody>
                    <script>
                        var array_class = [];
                    </script>
                    @php $list_num = 1; @endphp
                    @foreach($top_line as $t_data)
                    @php $g_line_id=$t_data->line_id; @endphp
                    <tr id="tr_top_{{ $g_line_id }}">
                        <th id="top_name_{{ $g_line_id }}">
                            Top {{ $list_num }}
                        </th>
                        <td>
                            <span id="top_line_name_{{ $g_line_id }}">{{ $t_data->l_name }}</span>
                        </td>
                        <td>
                            <span id="top_actual_target_{{ $g_line_id }}">{{ $t_data->total_actual }}</span>
                        </td>
                        <td>
                            <span id="top_actual_percent_{{ $g_line_id }}"></span>
                        </td>
                    </tr>
                    @php $list_num++; @endphp
                    <script>
                        window.addEventListener('initSomething3', event => { var top_percent = $("#actual_target_percent_actual_chart_{{ $g_line_id }}").text();
                        var top_actual_percent = $("#top_actual_percent_{{ $g_line_id }}");
                        top_actual_percent.text(top_percent);

                        $top_1 = $("#tr_top_1");
                        $top_1_th = $("#top_name_1");
                        $top_1_td = $("#tr_top_1 td");

                        $top_1.css('background-color','green');
                        $top_1_th.css('color','white');
                        $top_1_td.css('color','white');});
                    </script>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
