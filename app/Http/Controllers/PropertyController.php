<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Image;
use App\Models\Offer;
use App\Models\Location;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function index()
    {
        $property_land = DB::table("properties")->where('type', '=', 'land')->count();
        $property_appartment = DB::table("properties")->where('type', '=', 'apartment')->count();
        $property_chalet = DB::table("properties")->where('type', '=', 'chalet')->count();
        $property_office = DB::table("properties")->where('type', '=', 'office')->count();
        $property_house = DB::table("properties")->where('type', '=', 'house')->count();
        return view('admin.Properties', compact('property_land', 'property_appartment', 'property_chalet', 'property_office', 'property_house'));
    }


    public function fetchAll()
    {
        $Properties = Property::all();
        $output = '';
        if ($Properties->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>area</th>
                <th>room num</th>
                <th>bath num</th>
                <th>city name</th>
                <th>storey</th>
                <th>price</th>
                <th>price rent per day</th>
                <th>type</th>
                <th>created at</th>
                <th>updated at</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($Properties as $Property) {
                $city_name = DB::table('properties')
                    ->join('locations', 'properties.locations_id', '=', 'locations.id')
                    ->where('properties.locations_id', "=", $Property->locations_id)->get();
                $output .= '<tr>
                <td>' . $Property->area .  '</td>
                <td>' . $Property->room_num . '</td>
                <td>' . $Property->bath_num . '</td>
                <td>' .  $city_name[0]->city_name . '</td>
                <td>' . $Property->storey . '</td>
                <td>' . $Property->price  . '</td>
                <td>' . $Property->price_rent_per_day  . '</td>
                <td>' . $Property->type  . '</td>
                <td>' . $Property->created_at  . '</td>
                <td>' . $Property->updated_at  . '</td>


                <td>
                  <a href="#" id="' . $Property->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editpropertyModal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $Property->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    public function store(Request $request)
    {

        $locationData = ['longitude' => $request->lng, 'latitude' => $request->lat, 'city_name' => $request->city_name];
        $location = Location::create($locationData);
        $locationId = $location->id;
        $cover_image = $request->file('cover_image');
        $cover_name = optional($cover_image)->getClientOriginalName();
        $path_cover = optional($cover_image)->storeAs('uploads', $cover_name,'public');
        $PropertyData = ['area' => $request->area, 'locations_id' => $locationId, 'room_num' => $request->room_num, 'bath_num' => $request->bath_num, 'storey' => $request->storey, 'price' => $request->price, 'price_rent_per_day' => $request->price_per_day, 'type' => $request->property_type, 'cover_image' => '/uploads/' . $path_cover, 'disc' => $request->disc];
        $property = Property::create($PropertyData);
        $propertyId = $property->id;
        $images = $request->file('images');
        if ($images) {
            foreach ($images as $image) {
                $name = $image->getClientOriginalName();
                $path = $image->storeAs('uploads', $name, 'public');

                Image::create([
                    'property_id' => $propertyId,
                    'path' => '/uploads/' . $path

                ]);
            }
        }
        $offerData = ['seller_id' => $request->seller_id, 'approved_by' => NULL, 'property_id' => $propertyId, 'approve_date' => NULL, 'offer_type' => $request->offer_type, 'status' => 'pending'];
        $offer = Offer::create($offerData);
        if (Auth::user()->hasRole('seller')) {

            return    redirect()->back()->with('message', 'تمت اضافة العرض بنجاح وهوي بانتظار الموافقة حاليا');
        }
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Property ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $Property = Property::find($id);
        return response()->json($Property);
    }

    // handle update an Property ajax request
    public function update(Request $request)
    {
        $fileName = '';
        $Property = Property::find($request->property_id);
        $location = Location::find($Property->locations_id);

        if ($request->hasFile('images')) {
            $images = $request->file('images');

            foreach ($images as $image) {
                $name = $image->getClientOriginalName();
                $path = $image->storeAs('uploads', $name, 'public');
                Image::create([
                    'property_id' => $Property->id,
                    'path' => '/uploads/' . $path

                ]);
            }
        }
        $cover_image = $request->file('cover_image');
        $cover_name = $cover_image->getClientOriginalName();
        $path_cover = $cover_image->storeAs('uploads', $cover_name,'public');

        $PropertyData = ['area' => $request->area, 'locations_id' => $Property->locations_id, 'room_num' => $request->room_num, 'bath_num' => $request->bath_num, 'storey' => $request->storey, 'price' => $request->price, 'price_rent_per_day' => $request->price_per_day, 'type' => $request->property_type, 'cover_image' => '/uploads/' . $path_cover, 'disc' => $request->disc];
        $locationData = ['longitude' => $request->lng, 'latitude' => $request->lat, 'city_name' => $request->city_name];

        $Property->update($PropertyData);

        $location->update($locationData);

        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete an Property ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        $Property = Property::find($id);
        Property::destroy($Property->id);
        Image::destroy($Property->id);
    }
    public function detail($id)
    {
        $property =   DB::table('offers')->where('offers.property_id', '=', $id)
            ->join('images', function ($join) {
                $join->on('offers.property_id', '=', 'images.property_id');
            })->join('properties', function ($join) {
                $join->on('properties.id', '=', 'images.property_id');
            })->join('locations', function ($join) {
                $join->on('locations.id', '=', 'properties.locations_id');
            })
            ->get();
        $offer = DB::table('offers')->where('offers.property_id', '=', $id)->get();
        return view('property.details', compact('property', 'offer'));
    }
}
