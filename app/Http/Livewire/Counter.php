<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Counter extends Component
{
    public $page_number = 8;

    public $search = "";
    public $search2 = "";
    public $search3 = ">";
    public $search4 = "0";
    public $search5 = "";

    public function render()
    {
        $offers = DB::table('offers')
            ->join('properties', 'offers.property_id', '=', 'properties.id')
            ->join('locations', 'properties.locations_id', '=', 'locations.id')
            ->where('offers.status', "=", "approved")->where('offer_type', 'like', '%' . $this->search . '%')->where('city_name', 'like', $this->search2 . '%')->where('price', $this->search3, $this->search4)
            ->where('type', 'like', '%' . $this->search5 . '%')
            ->orderBy('offers.created_at', 'DESC')->paginate($this->page_number);
        return view('livewire.customer_dash', ['offers' => $offers])->layout('layouts.app_customer');
    }
    public function load_more()
    {
        $this->page_number += 8;
    }
}
