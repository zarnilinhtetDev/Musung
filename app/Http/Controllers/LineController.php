<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Line;


class LineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user(); // here the user should exist from the session
            return $next($request);
        });
    }

    //// View for Line Detail
    public function index()
    {
        $request = Request::create('/api/line', 'GET');
        // $request->headers->set('X-Authorization', 'wAH2k5uRc2Sgsz8gm3rdq0eEUHchz2syWHfLuLoCEWXpyCtkers4a1OeIGL1CST0');

        $response = Route::dispatch($request);

        $responseBody = $response->getContent();

        return view('line_management.detail', compact('responseBody'));
    }

    public function postLine()
    {
        $name = request()->post('l_name');
        $name_str_replace = str_replace(' ', '', strtolower($name));

        $line_select = Line::select('l_name')->get()->toArray();
        $arr = [];
        $decode = json_decode(json_encode($line_select), true);
        for ($i = 0; $i < count($decode); $i++) {
            $arr[] = str_replace(' ', '', strtolower($decode[$i]['l_name']));
        }

        if (stripos(json_encode($arr), $name_str_replace) !== false) {
            return redirect()->back()->withErrors(['error' => 'Line name already exists !!!']);
        } else {
            $pos = request()->post('l_pos');
            $line_model = Line::create(['l_name' => $name, 'l_pos' => $pos, 'created_at' => NOW()]);
            if ($line_model == true) {
                return redirect()->back()->withErrors(['success' => 'Line Created Successfully !!!']);
            }
        }
    }

    public function putLine()
    {
        $id = request()->post('l_id');
        $name = request()->post('l_name');
        $pos = request()->post('l_pos');

        $line_model = Line::where('l_id', $id)->update(['l_name' => $name, 'l_pos' => $pos]);
        if ($line_model == true) {
            return redirect('/line_detail?status=update_ok');
        }
    }
    public function softDelete()
    {
        $id = request()->get('id');

        $line_model = Line::where('l_id', $id)->update(['is_delete' => 1]);
        if ($line_model == true) {
            return redirect('/line_detail?status=soft_delete_ok');
        }
    }
    public function undoLine()
    {
        $id = request()->get('id');

        $line_model = Line::where('l_id', $id)->update(['is_delete' => 0]);
        if ($line_model == true) {
            return redirect('/line_detail?status=undo_ok');
        }
    }
}
