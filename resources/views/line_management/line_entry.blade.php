@extends('layouts.app')

@section('content')
@section('content_2')
<div class="container">
    <div class="container-fluid">
        <h1 class="fw-bold heading-text">Line Entry</h1>

        <div class="container-fluid row p-0 m-0">
            <div class="col-12 col-md-6 my-3">
                <ul class="horizontal-slide" style="" id="tabs">
                    <li class="span2">
                        <p>Date - 1.1.2022</p>
                    </li>
                    <li class="span2">
                        <p>Line Manager 1</p>
                    </li>
                </ul>
            </div>
            <div class="col text-center text-md-start">
                <h1 class="fs-3 fw-bolder">Target = <span class="text-white bg-danger p-2 rounded-2">100</span></h1>
            </div>
        </div>

        <div id="tabmenu" class="container-fluid my-3 p-0">
            <ul class="horizontal-slide" id="nav">
                <li class="span2">
                    <a href="#" class="active">Line 1</a>
                </li>
                <li class="span2">
                    <a href="#">Line 2</a>
                </li>
                <li class="span2">
                    <a href="#">Line 3</a>
            </ul>
            <div id="tab-content">
                <div id="tab1" class="div_1">
                    <div class="row container-fluid p-0 m-0">
                        <div class="col-12 col-md-6 m-auto">
                            <div class="row container-fluid p-0 m-0">
                                <div class="col">
                                    <input class="btn btn-secondary text-center text-white fw-bold w-100" type="text"
                                        value="8:30" name="" readonly />
                                </div>
                                <div class="col-2 text-center m-auto">
                                    <span class="fw-bolder">=</span>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control text-center text-dark fw-bold w-100"
                                        placeholder="50" />
                                </div>
                                <div class="col">
                                    <input class="btn text-center text-dark fw-bold w-100"
                                        style="background-color:#ececec;" type="text" value="100" name="" readonly />
                                </div>
                            </div>
                            <div class="text-center my-4">
                                <input class="icon-btn-one btn my-2 w-50" type="submit" value="Save" name="submit" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6 p-0">
                            <div class="container-fluid m-0 rounded-3 shadow-lg p-0">
                                <h1 class="fw-bold heading-text fs-3 p-2">Target and Actual Chart</h1>
                                <div id="target_chart">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div id="tab2" class="div_1">
                    <p>This can contain anything.</p>
                </div>

                <div id="tab3" class="div_1">
                    <p>Like photos:</p><br />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@endsection
