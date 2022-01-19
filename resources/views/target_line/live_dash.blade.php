@extends('layouts.app')

@section('content')

@section('content_2')

<div class="container-fluid">
    <div class="container-fluid">
        <ul class="horizontal-slide" style="" id="tabs">
            <li class="span2 bg-transparent">
                <input class="icon-btn-one btn my-2" type="submit" value="Date - 1.1.2022" />
            </li>
            <li class="span2 bg-transparent">
                <input class="icon-btn-one icon-btn-one-2 btn my-2" type="submit" value="Export to Excel"
                    name="submit" />
            </li>
        </ul>
    </div>
    <div class="row container-fluid p-0 my-3 mx-auto">
        <div class="col-12 col-md-8">
            <div class="panel-body">
                <table class="table table-hover table-striped table-bordered text-center table-dash">
                    <thead>
                        <tr class="tr-2 tr-3">
                            <th scope="col">Line</th>
                            <th scope="col">Target</th>
                            <th scope="col">8:30</th>
                            <th scope="col">9:30</th>
                            <th scope="col">10:30</th>
                            <th scope="col">11:30</th>
                            <th scope="col">12:30</th>
                            <th scope="col">1:00</th>
                            <th scope="col">2:00</th>
                            <th scope="col">3:00</th>
                            <th scope="col">4:00</th>
                            <th scope="col">5:00</th>
                            <th scope="col">6:00</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                1
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td>1</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td>100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>2</td>
                                        <td>3</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">1</td>
                                        <td class="bg-danger">2</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td colspan="2" class="bg-danger">66.7%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>4</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>5</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>6</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>7</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>8</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>9</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>10</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>11</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>12</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>13</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                3
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td>1</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td>100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>2</td>
                                        <td>3</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">1</td>
                                        <td class="bg-danger">2</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td colspan="2" class="bg-danger">66.7%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>4</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>5</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>6</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>7</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>8</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>9</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>10</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>11</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>12</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>13</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                4
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td>1</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td>100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>2</td>
                                        <td>3</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">1</td>
                                        <td class="bg-danger">2</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td colspan="2" class="bg-danger">66.7%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>4</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>5</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>6</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>7</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>8</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>9</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>10</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>11</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>12</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>13</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                4S
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td>1</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td>100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>2</td>
                                        <td>3</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">1</td>
                                        <td class="bg-danger">2</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td colspan="2" class="bg-danger">66.7%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>4</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>5</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>6</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>7</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>8</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>9</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>10</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>11</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>12</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>13</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                5A
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td>1</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td>100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>2</td>
                                        <td>3</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">1</td>
                                        <td class="bg-danger">2</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td colspan="2" class="bg-danger">66.7%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>4</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>5</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>6</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>7</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>8</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>9</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>10</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>11</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>12</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>13</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                5S
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td>1</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td>100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>2</td>
                                        <td>3</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">1</td>
                                        <td class="bg-danger">2</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td colspan="2" class="bg-danger">66.7%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>4</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>5</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>6</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>7</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>8</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>9</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>10</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>11</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>12</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>13</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                8
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td>1</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td>100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>2</td>
                                        <td>3</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">1</td>
                                        <td class="bg-danger">2</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td colspan="2" class="bg-danger">66.7%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>4</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>5</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>6</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>7</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>8</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>9</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>10</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>11</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>12</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>13</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Mini
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td>1</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td>100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>2</td>
                                        <td>3</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">1</td>
                                        <td class="bg-danger">2</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td colspan="2" class="bg-danger">66.7%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>4</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>5</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>6</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>7</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>8</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>9</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>10</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>11</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>12</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>13</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Total
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td>1</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td>100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>2</td>
                                        <td>3</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">1</td>
                                        <td class="bg-danger">2</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td colspan="2" class="bg-danger">66.7%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>4</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>5</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>6</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>7</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>8</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>9</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>10</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-danger">2</td>
                                        <td class="bg-danger">4</td>
                                    </tr>
                                    <tr class="bg-danger text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>11</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>12</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="w-100 text-center">
                                    <tr>
                                        <td>1</td>
                                        <td>13</td>
                                    </tr>
                                    <tr class="text-white">
                                        <td class="bg-success">2</td>
                                        <td class="bg-success">4</td>
                                    </tr>
                                    <tr class="bg-success text-white">
                                        <td colspan="2">100%</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12 col-md-4 p-0">
            <div class="container-fluid p-0 h-100">
                <div class="div-bg-1 h-100">
                    <h1 class="fw-bold heading-text fs-3 p-2">Today's Percentage Chart</h1>
                    <div id="live_bar_chart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-0 my-3">
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="div-bg-1">
                    <h1 class="fw-bold heading-text fs-3 p-2">Actual Percentage Chart</h1>
                    <div class="panel-body">
                        <table class="table table-hover table-striped table-bordered text-center">
                            <thead>
                                <tr class="tr-2 tr-3">
                                    <th scope="col">Line Name</th>
                                    <th scope="col">Line 1</th>
                                    <th scope="col">Line 3</th>
                                    <th scope="col">Line 4</th>
                                    <th scope="col">Line 4S</th>
                                    <th scope="col">Line 5A</th>
                                    <th scope="col">Line 5</th>
                                    <th scope="col">Line 5S</th>
                                    <th scope="col">Line 8</th>
                                    <th scope="col">Line Mini</th>
                                    <th scope="col">Line Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>
                                        Target
                                    </th>
                                    <td>
                                        370
                                    </td>
                                    <td>
                                        224
                                    </td>
                                    <td>
                                        315
                                    </td>
                                    <td>
                                        405
                                    </td>
                                    <td>
                                        564
                                    </td>
                                    <td>
                                        871
                                    </td>
                                    <td>
                                        809
                                    </td>
                                    <td>
                                        286
                                    </td>
                                    <td>
                                        188
                                    </td>
                                    <td>
                                        4032
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Actual
                                    </th>
                                    <td>
                                        332
                                    </td>
                                    <td>
                                        111
                                    </td>
                                    <td>
                                        278
                                    </td>
                                    <td>
                                        240
                                    </td>
                                    <td>
                                        385
                                    </td>
                                    <td>
                                        770
                                    </td>
                                    <td>
                                        340
                                    </td>
                                    <td>
                                        173
                                    </td>
                                    <td>
                                        148
                                    </td>
                                    <td>
                                        2777
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        %
                                    </th>
                                    <td>
                                        90%
                                    </td>
                                    <td>
                                        50%
                                    </td>
                                    <td>
                                        88%
                                    </td>
                                    <td>
                                        59%
                                    </td>
                                    <td>
                                        68%
                                    </td>
                                    <td>
                                        88%
                                    </td>
                                    <td>
                                        42%
                                    </td>
                                    <td>
                                        60%
                                    </td>
                                    <td>
                                        79%
                                    </td>
                                    <td>
                                        69%
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 p-sm-0 p-md-auto my-sm-2 my-md-0 top-3">
                <div class="div-bg-1">
                    <h1 class="fw-bold heading-text fs-3 p-2">Top 3 Lines and Last Line Data</h1>
                    <div class="panel-body">
                        <table class="table table-hover table-striped table-bordered text-center">
                            <tbody>
                                <tr class="bg-success">
                                    <th class="text-white">
                                        Top 1
                                    </th>
                                    <td class="text-white">
                                        Line 1
                                    </td>
                                    <td class="text-white">
                                        332
                                    </td>
                                    <td class="text-white">
                                        90%
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Top 2
                                    </th>
                                    <td>
                                        Line 5
                                    </td>
                                    <td>
                                        770
                                    </td>
                                    <td>
                                        88%
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Top 3
                                    </th>
                                    <td>
                                        Line 4
                                    </td>
                                    <td>
                                        278
                                    </td>
                                    <td>
                                        70%
                                    </td>
                                </tr>
                                <tr class="bg-danger text-white">
                                    <th>
                                        Last
                                    </th>
                                    <td>
                                        Line 5S
                                    </td>
                                    <td>
                                        340
                                    </td>
                                    <td>
                                        40%
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@endsection
