<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Offer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function approve(Request $request)
    {
        $date = Carbon::now();


        $order = Order::findOrFail($request->id);
        $order->status = "approved";
        $order->start = $date;

        $order->save();

        $offer = Offer::findOrFail($order->offers_id);
        if ($offer->offer_type == "Sale") {
            $offer->status = "Sold";
            $offer->save();
        } else {
            $offer->status = "rented";
            $offer->save();
        }

        $this->changeRank($order->customer_id);
        $this->changeRank($offer->seller_id);

        return response()->json([
            'status' => 200,
        ]);
    }

    public function reject(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->status = "rejected"; //rejected
        $order->save();
        return response()->json([
            'status' => 200,
        ]);
    }
    public function index()
    {
        $orders_approve = DB::table("orders")->where('status', '=', 'approved')->count();
        $orders_rejected = DB::table("orders")->where('status', '=', 'rejected')->count();
        $orders_pending = DB::table("orders")->where('status', '=', 'pending')->count();
        return view('admin.orders', compact('orders_approve', 'orders_rejected', 'orders_pending'));
    }
    public function fetchAll()
    {
        $orders = Order::all();

        $output = '';
        if ($orders->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>Seller Name</th>
                <th>Customer Name</th>
                <th>offers number</th>
                <th>status</th>
                <th>start</th>
                <th>end </th>
             <th>created at</th>

                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($orders as $order) {
                $customer_name = DB::table('orders')
                    ->join('users', 'orders.customer_id', '=', 'users.id')
                    ->where('orders.customer_id', "=", $order->customer_id)->get();
                $seller_name = DB::table('orders')
                    ->join('offers', 'orders.offers_id', '=', 'offers.id')
                    ->join('users', 'users.id', '=', 'offers.seller_id')
                    ->where('orders.offers_id', "=", $order->offers_id)->get();



                $output .= '<tr>
                <td>' .   $seller_name[0]->first_name . ' ' . $seller_name[0]->last_name .  '</td>
                <td>' .   $customer_name[0]->first_name . ' ' . $customer_name[0]->last_name .  '</td>
                <td>' . $order->offers_id . '</td>';

                if ($order->status == 'pending') {
                    $output .=  '<td style="background-color:#49B9F9; color:#fff;">' . $order->status;
                } else if ($order->status == 'approved') {

                    $output .=  '<td style="background-color:#157347; color:#fff;">' . $order->status;
                } else {
                    $output .=  '<td style="background-color:#DC3545; color:#fff;">' . $order->status;
                }
                $output .= '</td>'
                    . '<td>' . $order->start . '</td>
                <td>' . $order->end . '</td>
                <td>' . $order->created_at  . '</td>
                <td>';
                if ($order->status == 'pending') {
                    $output .=   '<button href="#"   id="' . $order->id . '"type="button" class="btn btn-success approveIcon">Approve</button>
                    <button href="#" id="' . $order->id . ' type="button" class="btn btn-danger rejectIcon">Reject</button>';
                } else if ($order->status == 'approved') {

                    $output .=   '<button href="#" id="' . $order->id . ' type="button" class="btn btn-danger rejectIcon">Reject</button>';
                } else {
                    $output .=   '<button href="#"   id="' . $order->id . '"type="button" class="btn btn-success approveIcon">Approve</button>';
                }


                $output .=  '</td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }
    public function storeBuy(Request $request)
    {

        $seller_id = DB::table("offers")->where('id', '=', $request->offer_id)->get();
        if ($seller_id[0]->seller_id == $request->customer_id) {

            return    redirect()->back()->with('message', 'لايمكنك طلب شراء عقار انت قمت بعرضه!!!!');
        } else {
            $orderData = ['customer_id' => $request->customer_id, 'offers_id' => $request->offer_id, 'status' => 'pending', 'start' => NUll, 'end' => Null];
            $allorders = DB::table("orders")->get();

            foreach ($allorders as $order) {
                if ($order->customer_id == $request->customer_id && $order->offers_id == $request->offer_id && $order->status == "pending") {
                    return    redirect()->back()->with('message', 'انت قمت بطلب هذا العقار مسبقا الرجاء الانتظار طلبك معلق حاليا');
                } else if ($order->customer_id == $request->customer_id && $order->offers_id == $request->offer_id && $order->status == "approved") {
                    return    redirect()->back()->with('message', 'انت قمت بطلب هذا العقار مسبقا وتمت الموافقة عليه');
                }
            }

            $order = Order::create($orderData);


            return    redirect()->back()->with('message', 'تم ارسال طلب الشراء وهوي قيد المراجعة حاليا');
        }
    }
    public function storeRent(Request $request)
    {
        $seller_id = DB::table("offers")->where('id', '=', $request->offer_id)->get();
        if ($seller_id[0]->seller_id == $request->customer_id) {

            return    redirect()->back()->with('message', 'لايمكنك طلب إيجار عقار انت قمت بعرضه!!!!');
        } else {
            $orderData = ['customer_id' => $request->customer_id, 'offers_id' => $request->offer_id, 'status' => 'pending', 'end' => $request->end_date, 'start' => NUll];

            $allorders = DB::table("orders")->get();

            foreach ($allorders as $order) {
                if ($order->customer_id == $request->customer_id && $order->offers_id == $request->offer_id && $order->status == "pending") {
                    return    redirect()->back()->with('message', 'انت قمت بطلب هذا العقار مسبقا الرجاء الانتظار طلبك معلق حاليا');
                } else if ($order->customer_id == $request->customer_id && $order->offers_id == $request->offer_id && $order->status == "approved") {
                    return    redirect()->back()->with('message', 'انت قمت بطلب هذا العقار مسبقا وتمت الموافقة عليه');
                }
            }
            $order = Order::create($orderData);

            return    redirect()->back()->with('message', ' تم ارسال طلب الإيجار وهوي قيد المراجعة حاليا');
        }
    }



    public function myorders($id)
    {

        $myorders_approved =   DB::table('orders')->where('orders.customer_id', '=', $id)->where('orders.status', '=', "approved")
            ->join('offers', function ($join) {
                $join->on('offers.id', '=', 'orders.offers_id');
            })
            ->join('properties', function ($join) {
                $join->on('properties.id', '=', 'offers.property_id');
            })->join('locations', function ($join) {
                $join->on('locations.id', '=', 'properties.locations_id');
            })
            ->get();



        $myorders_rejected =   DB::table('orders')->where('orders.customer_id', '=', $id)->where('orders.status', '=', "rejected")
            ->join('offers', function ($join) {
                $join->on('offers.id', '=', 'orders.offers_id');
            })
            ->join('properties', function ($join) {
                $join->on('properties.id', '=', 'offers.property_id');
            })->join('locations', function ($join) {
                $join->on('locations.id', '=', 'properties.locations_id');
            })
            ->get();



        $myorders_pending =   DB::table('orders')->where('orders.customer_id', '=', $id)->where('orders.status', '=', "pending")
            ->join('offers', function ($join) {
                $join->on('offers.id', '=', 'orders.offers_id');
            })
            ->join('properties', function ($join) {
                $join->on('properties.id', '=', 'offers.property_id');
            })->join('locations', function ($join) {
                $join->on('locations.id', '=', 'properties.locations_id');
            })
            ->get();


        return view('orders.myorders', compact('myorders_approved', 'myorders_rejected', 'myorders_pending'));
    }

    public function changeRank($id)
    {


        $user = User::findOrFail($id);
        $user->Rank++;

        $user->save();


        return response()->json([
            'status' => 200,
        ]);
    }
}
