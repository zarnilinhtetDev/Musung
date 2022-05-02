<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\BuyerList;

class BuyerListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user(); // here the user should exist from the session
            return $next($request);
        });
    }
    public function postBuyer()
    {
        $buyer_name = request()->post('buyer_name');
        $remark = request()->post('buyer_remark');

        $query = BuyerList::create([
            'buyer_name' => $buyer_name,
            'remark' => $remark,
        ]);
    }
    public function deleteBuyer(){
        $buyer_id = request()->get('id');

        $query = BuyerList::where('buyer_id', $buyer_id)->delete();

        if($query){
            return redirect('/line_setting');
        }
    } public function editBuyer(){
        $buyer_id = request()->post('buyer_id');
        $buyer_name = request()->post('buyer_name');
        $remark = request()->post('buyer_remark');

        $query = BuyerList::where('buyer_id', $buyer_id)->update([
            'buyer_name' => $buyer_name,
            'remark' => $remark,
        ]);

        if($query){
            return redirect('/line_setting');
        }
    }
}
