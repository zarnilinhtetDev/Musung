<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductCategory;
use App\Models\ItemList;
use App\Models\BuyerList;

class SelectBoxSetting extends Component
{
    public function render()
    {
        $p_detail = ProductCategory::all();
        $item_detail = ItemList::all();
        $buyer_detail = BuyerList::all();
        return view('livewire.select-box-setting', compact('p_detail','item_detail','buyer_detail'));
    }
}
