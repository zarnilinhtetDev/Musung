<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductCategory;

class SelectBoxSetting extends Component
{
    public function render()
    {
        $p_detail = ProductCategory::all();
        return view('livewire.select-box-setting', compact('p_detail'));
    }
}
