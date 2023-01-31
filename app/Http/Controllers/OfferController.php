<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Image;


use App\Models\Offer;
use App\Models\Location;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{

    public function approve(Request $request)
    {
        $date = Carbon::now();


        $offer = Offer::findOrFail($request->id);
        $offer->status = "approved"; //Approved
        $offer->approved_by = Auth::id();
        $offer->approve_date = $date;
        $offer->save();

        return response()->json([
            'status' => 200,
        ]);
    }

    public function reject(Request $request)
    {
        $offer = Offer::findOrFail($request->id);
        $offer->status = "rejected";
        $offer->save();
        return response()->json([
            'status' => 200,
        ]);
    }
    public function index()
    {
        $offers_approve = DB::table("offers")->where('status', '=', 'approved')->count();
        $offers_rejected = DB::table("offers")->where('status', '=', 'rejected')->count();
        $offers_pending = DB::table("offers")->where('status', '=', 'pending')->count();
        $offers_rented = DB::table("offers")->where('status', '=', 'rented')->count();
        $offers_sold = DB::table("offers")->where('status', '=', 'sold')->count();
        return view('admin.offers', compact('offers_approve', 'offers_rejected', 'offers_pending', 'offers_sold', 'offers_rented'));
    }
    public function fetchAll()
    {
        $offers = Offer::all();
        $output = '';
        if ($offers->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
        <thead>
          <tr>
          <th> offer Number</th>
            <th> seller name</th>
            <th>property number</th>
            <th>offer type</th>
            <th>status</th>
            <th>created at</th>
            <th>updated at</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>';
            foreach ($offers as $offer) {
                $seller_name = DB::table('offers')
                    ->join('users', 'offers.seller_id', '=', 'users.id')
                    ->where('offers.seller_id', "=", $offer->seller_id)->get();
                $output .= '<tr>
            <td>' . $offer->id .  '</td>

            <td>' . $seller_name[0]->first_name . ' ' . $seller_name[0]->last_name . '</td>

            <td>' . $offer->property_id . '</td>
            <td>' . $offer->offer_type . '</td>';
                if ($offer->status == 'pending') {
                    $output .=  '<td style="background-color:#49B9F9;color:#fff;">' . $offer->status;
                } else if ($offer->status == 'approved') {

                    $output .=  '<td style="background-color:#157347;color:#fff;">' . $offer->status;
                } else if ($offer->status == 'sold') {

                    $output .=  '<td style="background-color:#343A40;color:#fff;">' . $offer->status;
                } else if ($offer->status == 'rented') {

                    $output .=  '<td style="background-color:#E0A800;color:#fff;">' . $offer->status;
                } else {
                    $output .=  '<td style="background-color:#DC3545; color:#fff;">' . $offer->status;
                }
                $output .= '</td>
            <td>' . $offer->created_at  . '</td>
            <td>' . $offer->updated_at  . '</td>
            <td>';
                if ($offer->status == 'pending') {
                    $output .= '<button href="#"   id="' . $offer->id . '"type="button" class="btn btn-success approveIcon">Approve</button>
            <button href="#" id="' . $offer->id . ' type="button" class="btn btn-danger rejectIcon">Reject</button>
            </td>';
                } elseif ($offer->status == 'approved') {
                    $output .= '<button href="#" id="' . $offer->id . ' type="button" class="btn btn-danger rejectIcon">Reject</button></td>';
                } elseif ($offer->status == 'sold') {
                    // $output .='<button href="#"   id="' . $offer->id . '"type="button" class="btn btn-success approveIcon">Approve</button></td>';

                } elseif ($offer->status == 'rented') {
                    // $output .='<button href="#"   id="' . $offer->id . '"type="button" class="btn btn-success approveIcon">Approve</button></td>';

                } else {
                    $output .= '<button href="#"   id="' . $offer->id . '"type="button" class="btn btn-success approveIcon">Approve</button></td>';
                }

                $output .=  '</tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }



    public function getAllOffers()
    {
        $offers = Offer::all();
        return view('customerdash', compact('offers'));
    }
    public function getLastOffers()
    {
        $offers = DB::table('offers')
            ->join('properties', 'offers.property_id', '=', 'properties.id')
            ->join('locations', 'properties.locations_id', '=', 'locations.id')
            ->where('offers.status', "approved")
            ->orderBy('offers.created_at', 'DESC')->take(5)->get();
        $offers_nice = DB::table('offers')
            ->join('properties', 'offers.property_id', '=', 'properties.id')
            ->join('locations', 'properties.locations_id', '=', 'locations.id')
            ->where('offers.status', "approved")
            ->orderBy('offers.created_at', 'DESC')->take(8)->get();
        return view('welcome', compact('offers', 'offers_nice'));
    }
    public function myoffers($id)
    {

        $myoffers_pending =   DB::table('offers')->where('offers.seller_id', '=', $id)->where('offers.status', '=', "pending")
            ->join('properties', function ($join) {
                $join->on('properties.id', '=', 'offers.property_id');
            })->join('locations', function ($join) {
                $join->on('locations.id', '=', 'properties.locations_id');
            })
            ->get();
        $myoffers_rejected =   DB::table('offers')->where('offers.seller_id', '=', $id)->where('offers.status', '=', "rejected")
            ->join('properties', function ($join) {
                $join->on('properties.id', '=', 'offers.property_id');
            })->join('locations', function ($join) {
                $join->on('locations.id', '=', 'properties.locations_id');
            })
            ->get();
        $myoffers_approved =   DB::table('offers')->where('offers.seller_id', '=', $id)->where('offers.status', '=', "approved")
            ->join('properties', function ($join) {
                $join->on('properties.id', '=', 'offers.property_id');
            })->join('locations', function ($join) {
                $join->on('locations.id', '=', 'properties.locations_id');
            })
            ->get();
        $myoffers_sold =   DB::table('offers')->where('offers.seller_id', '=', $id)->where('offers.status', '=', "sold")
            ->join('properties', function ($join) {
                $join->on('properties.id', '=', 'offers.property_id');
            })->join('locations', function ($join) {
                $join->on('locations.id', '=', 'properties.locations_id');
            })
            ->get();
        return view('myOffers.myoffers', compact('myoffers_pending', 'myoffers_approved', 'myoffers_rejected', 'myoffers_sold'));
    }

    public function edit_offer($id)
    {
        $property =   DB::table('offers')->where('offers.property_id', '=', $id)
            ->join('properties', function ($join) {
                $join->on('properties.id', '=', 'offers.property_id');
            })->join('locations', function ($join) {
                $join->on('locations.id', '=', 'properties.locations_id');
            })
            ->get();
        $offer = DB::table('offers')->where('offers.property_id', '=', $id)->get();
        return view('myOffers.edit_offer', compact('offer', 'property'));
    }
    public function update(Request $request)
    {

        $offer_data = Offer::find($request->offer_id);
        $fileName = '';
        $Property = Property::find($offer_data->property_id);
        $location = Location::find($Property->locations_id);
        $images = $request->file('images');

        if ($images) {
            foreach ($images as $image) {
                $name = $image->getClientOriginalName();

                $path = $image->storeAs('uploads', $name, 'public');
                Image::create([
                    'property_id' => $offer_data->property_id,
                    'path' => '/uploads/' . $path

                ]);
            }
        }
        $cover_image = $request->file('cover_image');
        $cover_name = $cover_image->getClientOriginalName();
        $path_cover = $cover_image->storeAs('uploads', $cover_name,'public');

        $PropertyData = ['area' => $request->area, 'locations_id' => $Property->locations_id, 'room_num' => $request->room_num, 'bath_num' => $request->bath_num, 'storey' => $request->storey, 'price' => $request->price, 'price_rent_per_day' => $request->price_per_day, 'type' => $request->property_type, 'cover_image' => '/uploads/' . $path_cover, 'disc' => $request->disc];
        $locationData = ['longitude' => $request->lng, 'latitude' => $request->lat, 'city_name' => $request->city_name];
        $offer_data->status = "pending";
        $offer_data->save();
        $Property->update($PropertyData);

        $location->update($locationData);
        return    redirect()->back()->with('message', "تم تعديل البيانات بانتظار المراجعة من الادارة");
    }
    public function delete(Request $request)
    {

        $offer_data = Offer::find($request->offer_id);
        Offer::destroy($offer_data->id);
        $Property = Property::find($offer_data->property_id);
        Property::destroy($Property->id);
        Image::destroy($Property->id);
        return    redirect('/myOffers/' . Auth::user()->id)->with('message', 'تمت حذف العرض');
    }
}
