<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Line;

class LineApiController extends Controller
{
    public function getLine()
    {
        $line = Line::orderBy('l_pos', 'asc')->get();
        return response()->json($line);
    }

    public function postLine(Request $request)
    {
        $name = $request->l_name;
        $pos = $request->l_pos;
        $created_at = NOW();
        $line_model = Line::create(['l_name' => $name, 'l_pos' => $pos, 'created_at' => $created_at]);
        if ($line_model == true) {
            return response()->json(["create" => true]);
        }
    }
    public function putLine(Request $request)
    {
        $id = $request->l_id;
        $pos = $request->l_pos;
        $updated_at = NOW();
        $line_model = Line::where('l_id', $id)->update(['l_pos' => $pos, 'updated_at' => $updated_at]);
        if ($line_model == true) {
            return response()->json(["update" => true]);
        }
    }
    public function softDelete(Request $request)
    {
        $id = $request->l_id;
        $line_model = Line::where('l_id', $id)->update(['is_delete' => 1]);
        if ($line_model == true) {
            return response()->json(["soft_delete" => true]);
        }
    }
}
