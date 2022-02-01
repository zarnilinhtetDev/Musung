<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\LineAssign;
use App\Models\Line;
use App\Models\OverTime;

class LineAssignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user(); // here the user should exist from the session
            return $next($request);
        });
    }

    /////View for Line Setting
    public function index()
    {
        $line_assign = LineAssign::all();
        $overTime = OverTime::all();
        $line_assign_2 = DB::select('SELECT "line_assign".assign_id,"line_assign".user_id,"line_assign".l_id,"line_assign".main_target,"line_assign".s_time,"line_assign".e_time,"line_assign".lunch_s_time,"line".a_status,"line_assign".lunch_e_time,"line_assign".work_min,"line_assign".work_hr,"line_assign".created_at,"line_assign".updated_at,"line".l_name,"line".l_pos,"users".id,"users".name FROM line_assign,line,users WHERE "line".a_status=1 AND "line".is_delete=0 AND "line_assign".user_id="users".id AND "line_assign".l_id="line".l_id ORDER BY "line_assign".assign_id ASC');

        $request = Request::create('/api/line', 'GET');
        $request2 = Request::create('/api/user', 'GET');
        // $request->headers->set('X-Authorization', 'wAH2k5uRc2Sgsz8gm3rdq0eEUHchz2syWHfLuLoCEWXpyCtkers4a1OeIGL1CST0');

        $response = Route::dispatch($request);
        $response2 = Route::dispatch($request2);

        $responseBody = $response->getContent();
        $responseBody2 = $response2->getContent();

        DB::disconnect('musung');

        return view('line_management.setting', compact('responseBody', 'responseBody2', 'line_assign', 'line_assign_2', 'overTime'));
    }
    public function postLineSetting()
    {
        $l_id = request()->post('l_id');
        $line_manager = request()->post('l_manager');
        $s_time = request()->post('start_time');
        $e_time = request()->post('end_time');
        $target = request()->post('target');
        $work_hour = request()->post('work_hour');
        $lunch_start = request()->post('lunch_start');
        $lunch_end = request()->post('lunch_end');
        $progress = request()->post('progress');

        $line = Line::where('l_id', $l_id)->update(['a_status' => 1]);
        if ($line == true) {
            $line_assign = LineAssign::create(['user_id' => $line_manager, 'l_id' => $l_id, 'main_target' => $target, 's_time' => $s_time, 'e_time' => $e_time, 'lunch_s_time' => $lunch_start, 'lunch_e_time' => $lunch_end, 'work_min' => $progress, 'work_hr' => $work_hour, 'created_at' => NOW()]);

            if ($line_assign == true) {
                return redirect('/line_setting?status=create_ok');
            }
        }
    }

    public function postLineOverTimeSetting()
    {
        $l_id = request()->post('l_id');
        $over_time_minute = request()->post('over_time_minute');
        $over_time_target = request()->post('over_time_target');

        $overTime = OverTime::create(['l_id' => $l_id, 'ot_min' => $over_time_minute, 'ot_target' => $over_time_target, 'created_at' => NOW()]);
        if ($overTime == true) {
            return redirect('/line_setting?status=overtime_create_ok');
        }
    }
}
