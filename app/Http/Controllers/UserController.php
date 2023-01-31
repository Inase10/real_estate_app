<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index()
    {
        $customer_num = DB::table("users")->where('user_type', '=', 'Customer')->count();
        $seller_num = DB::table("users")->where('user_type', '=', 'Seller')->count();
        return view('admin.users', compact('customer_num', 'seller_num'));
    }
    public function fetchAll()
    {
        $users = User::all();
        $output = '';
        if ($users->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>Avatar</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>user Type</th>
                <th>bio</th>
                <th>created at</th>
                <th>updated at</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($users as $user) {
                $output .= '<tr>
                <td><img src="' . $user->avatar . '" width="50" class="img-thumbnail rounded-circle"></td>
                <td>' . $user->first_name . ' ' . $user->last_name . '</td>
                <td>' . $user->email . '</td>
                <td>' . $user->user_type . '</td>
                <td>' . $user->bio . '</td>
                <td>' . $user->created_at . '</td>
                <td>' . $user->updated_at  . '</td>

                <td>
                  <a href="#" id="' . $user->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editUserModal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $user->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
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
        $image = $request->file('avatar');
        $name = $image->getClientOriginalName();

        $path = $image->storeAs('uploads', $name, 'public');
        $userData = ['first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email, 'password' => $request->password, 'user_type' => $request->user_type, 'bio' => $request->bio, 'avatar' => '/uploads/' . $path];
        User::create($userData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an user ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        return response()->json($user);
    }

    // handle update an user ajax request
    public function update(Request $request)
    {
        $user = User::find($request->user_id);
        $image = $request->file('avatar');
        $name = optional($image)->getClientOriginalName();
        $path = optional($image)->storeAs('uploads', $name,'public');

        $userData = ['first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email, 'password' => Hash::make($request->password), 'user_type' => $request->user_type, 'bio' => $request->bio, 'avatar' => '/uploads/' . $path];
        $user->update($userData);
        return response()->json([
            'status' => 200,
        ]);
    }
    // handle delete an user ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        User::destroy($user->id);
    }

    public function profileAdmin()
    {
        return view('admin.profile-admin');
    }
}
