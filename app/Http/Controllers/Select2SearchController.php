<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BuyerList;

class Select2SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user(); // here the user should exist from the session
            return $next($request);
        });
    }

    public function selectSearch(Request $request)
    {
        $buyers = [];

        if ($request->has('q')) {
            $search = $request->q;
            $buyers = BuyerList::select("buyer_id", "buyer_name")
                ->where('buyer_name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($buyers);
    }
}
