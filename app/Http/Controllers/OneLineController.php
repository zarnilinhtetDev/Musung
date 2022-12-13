<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Line;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class OneLineController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user(); // here the user should exist from the session
            return $next($request);
        });
    }

    public function index($id, $date)
    {
        $line_id = $id;
        $line_date = $date;

        return view('line_management.one_line', compact('line_id', 'line_date'));
    }

    public function undoUser()
    {
        $id = request()->get('id');

        $request = Request::create(
            '/api/user_undo',
            'PUT',
            [
                'id' => request()->get('id'),
            ]
        );
        $response = Route::dispatch($request);

        return redirect('/member');
    }
}
