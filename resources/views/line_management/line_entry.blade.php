@extends('layouts.app')

@section('content')
@section('content_2')
<div class="container">
    <script>
        // ///// Numpad /////
        // // Set NumPad defaults for jQuery mobile.
        // // These defaults will be applied to all NumPads within this document!
        // $.fn.numpad.defaults.gridTpl = '<table class="table modal-content"></table>';
        // $.fn.numpad.defaults.backgroundTpl = '<div class="modal-backdrop in"></div>';
        // $.fn.numpad.defaults.displayTpl = '<input type="text" class="form-control" />';
        // $.fn.numpad.defaults.buttonNumberTpl =
        //     '<button type="button" class="btn btn-default"></button>';
        // $.fn.numpad.defaults.buttonFunctionTpl =
        //     '<button type="button" class="btn" style="width: 100%;"></button>';
        // $.fn.numpad.defaults.onKeypadCreate = function () {
        //     $(this).find(".done").addClass("btn-primary");
        // };

        // // Instantiate NumPad once the page is ready to be shown
        // $(document).ready(function () {
        //     $("#text-basic").numpad();
        //     $("#password").numpad({
        //         displayTpl: '<input class="form-control" type="password" />',
        //         hidePlusMinusButton: true,
        //         hideDecimalButton: true,
        //     });
        //     $("#numpadButton-btn").numpad({
        //         target: $("#numpadButton"),
        //     });
        //     $("#numpad4div").numpad();
        //     $("#numpad4column .qtyInput").numpad();

        //     $("#numpad4column tr").on("click", function (e) {
        //         $(this).find(".qtyInput").numpad("open");
        //     });
        // });
    </script>
    @php
    $json = json_decode($responseBody,true);
    @endphp
    <div class="container-fluid">
        <h1 class="fw-bold heading-text">Line Entry</h1>

        <div class="container-fluid row p-0 m-0">
            <div class="col-12 col-md-6 my-3">
                <ul class="horizontal-slide" id="tabs">
                    <li class="span2">
                        <p>Date - 1.1.2022</p>
                    </li>
                    <li class="span2">
                        <p>{{ Auth::user()->name }}</p>
                    </li>
                </ul>
            </div>
            <div class="col text-center text-md-start">
                <h1 class="fs-3 fw-bolder">Target = <span class="text-white bg-danger p-2 rounded-2">@php
                        $target = 1000;
                        echo $target; @endphp</span></h1>
            </div>
        </div>

        <div id="tabmenu" class="container-fluid my-3 p-0">
            <ul class="horizontal-slide" id="nav">
                <li class="span2">
                    <a href="#" class="active">Line 1</a>
                </li>
            </ul>
            <div id="tab-content">
                <div id="tab1" class="div_1">
                    <div class="row container-fluid p-0 m-0">
                        <div class="col-12 col-md-6 m-auto">
                            <div class="row container-fluid p-0 m-0">
                                <div class="col">Time</div>
                                <div class="col-2"></div>
                                <div class="col">Target</div>
                                <div class="col">Actual</div>
                            </div>
                            <form action="{{ url('line_entry_post') }}" action="POST">


                                @for($i=0;$i<count($json);$i++) @php $data_id=$json[$i]['data_id'];
                                    $status=$json[$i]['status'];
                                    $time_name=$json[$i]['time_name'];$line_name=$json[$i]['line_name'];
                                    $target=$json[$i]['target']; $actual=$json[$i]['actual_target'];
                                    $time_id=$json[$i]['time_id']; $line_id=$json[$i]['line_id']; @endphp
                                    @if($status=='0' ) <div class="row container-fluid p-0 my-2">
                                    <div class="col">
                                        <input class="btn btn-secondary text-center text-white fw-bold w-100"
                                            type="text" value="{{ $time_name }}" readonly />
                                    </div>
                                    <div class="col-2 text-center m-auto">
                                        <span class="fw-bolder">=</span>
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control" value="{{ $actual }}" readonly />
                                    </div>
                                    <div class="col">
                                        <input class="btn text-center text-dark fw-bold w-100"
                                            style="background-color:#ececec;" type="text" value="{{ $target }}"
                                            readonly />
                                    </div>
                        </div>

                        @endif

                        @if($status=='1')
                        <input type="hidden" name="status_one" value="1" />
                        <input type="hidden" name="data_id_one" value="{{ $data_id }}" />
                        <input type="hidden" name="time_id_one" value="{{ $time_id }}" />
                        <div class="row container-fluid p-0 my-2">
                            <div class="col">
                                <input class="btn btn-secondary text-center text-white fw-bold w-100" type="text"
                                    value="{{ $time_name }}" name="time_one" id="last-input" readonly />
                            </div>
                            <div class="col-2 text-center m-auto">
                                <span class="fw-bolder">=</span>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" value="{{ $actual }}" name="actual_one" />
                            </div>
                            <div class="col">
                                <input class="btn text-center text-dark fw-bold w-100" style="background-color:#ececec;"
                                    type="text" value="{{ $target }}" name="target_one" readonly />
                            </div>
                        </div>
                        @endif

                        @if($status=='2')
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                        <input type="hidden" name="line_id" value="{{ $line_id }}" />
                        <input type="hidden" name="time_id" value="{{ $time_id }}" />
                        <input type="hidden" name="status" value="{{ $status }}" />
                        <input type="hidden" name="data_id" value="{{ $data_id }}" />
                        <div class="row container-fluid p-0 my-2">
                            <div class="col">
                                <input class="btn btn-secondary text-center text-white fw-bold w-100" type="text"
                                    value="{{ $time_name }}" name="time" id="last-input" readonly />
                            </div>
                            <div class="col-2 text-center m-auto">
                                <span class="fw-bolder">=</span>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" id="text-basic" placeholder="Enter a number"
                                    name="actual" />
                            </div>
                            <div class="col">
                                <input class="btn text-center text-dark fw-bold w-100" style="background-color:#ececec;"
                                    type="text" value="100" name="target" readonly />
                            </div>
                        </div>
                        @endif
                        @endfor
                        <input type="hidden" id="add-time" name="add_time" />
                    </div>
                    <div class="col-12 col-md-6 p-0">
                        <div class="text-center my-4">
                            <input class="icon-btn-one btn my-2 w-50" type="submit" value="Save" name="submit" />
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@endsection
