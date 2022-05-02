<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ItemList;

class ItemListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::user(); // here the user should exist from the session
            return $next($request);
        });
    }
    public function postItem()
    {
        $item_name = request()->post('item_name');
        $remark = request()->post('item_remark');

        $query = ItemList::create([
            'item_name' => $item_name,
            'remark' => $remark,
        ]);
    }
    public function deleteItem(){
        $item_id = request()->get('id');

        $query = ItemList::where('item_id', $item_id)->delete();

        if($query){
            return redirect('/line_setting');
        }
    }
    public function editItem(){
        $item_id = request()->post('item_id');
        $item_name = request()->post('item_name');
        $remark = request()->post('item_remark');

        $query = ItemList::where('item_id', $item_id)->update([
            'item_name' => $item_name,
            'remark' => $remark,
        ]);

        if($query){
            return redirect('/line_setting');
        }
    }
}
