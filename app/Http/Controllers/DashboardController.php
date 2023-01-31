<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function changeRent($id)
    {
        $order_rent = Order::findOrFail($id);
        $order_rent->status = "rejected";
        $order_rent->save();
    }
    public function index()
    {

        $myoffers_rent =   DB::table('offers')->where('offers.status', '=', "rented")
            ->join('orders', function ($join) {
                $join->on('offers.id', '=', 'orders.offers_id')->where('orders.end', '!=', 'NULL');
            })
            ->get();
        foreach ($myoffers_rent as $items) {
            $currenttimestamp = date('Y-m-d');
            if ($currenttimestamp > $items->end) {


                $this->changeRent($items->id);
                $items = Offer::findOrFail($items->offers_id);
                $items->status = "approved";
                $items->save();
            }
        }
        $users_num = DB::table("users")->count();
        $offers_num = DB::table("offers")->count();
        $orders_num = DB::table("orders")->count();
        $property_num = DB::table("properties")->count();
        $offers = DB::table('offers')
            ->join('properties', 'offers.property_id', '=', 'properties.id')
            ->join('images', 'images.property_id', '=', 'properties.id')
            ->join('locations', 'properties.locations_id', '=', 'locations.id')
            ->where('offers.status', "approved")
            ->orderBy('offers.created_at', 'DESC')->paginate(4);
        if (Auth::user()->hasRole('seller')) {
            return    redirect()->route('seller');
        } elseif (Auth::user()->hasRole('customer')) {
            return    redirect()->route('customer');
        } else if (Auth::user()->hasRole('admin')) {
            return view('admin.dashboard', compact('users_num', 'offers_num', 'orders_num', 'property_num'));
        }
    }
    public function myprofile()
    {
        return view('user.myprofile');
    }
}
