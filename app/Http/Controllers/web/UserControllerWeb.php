<?php

namespace App\Http\Controllers\web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserControllerWeb extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    	// handle insert a new user ajax request
	public function store(Request $request) {
        // $fileName=NULL;
        // if($request->avatar){
		// $file = $request->file('avatar');
		// $fileName = time() . '.' . $file->getClientOriginalExtension();
		// $file->storeAs('public/images', $fileName);
        // }
        $image = $request->file('avatar');
        $name = $image->getClientOriginalName();
        $path = $image->storeAs('uploads', $name, 'public');



		$userData = ['first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email, 'password' => $request->password,'user_type' => $request->user_type, 'bio' => $request->bio, 'avatar' => '/storage/' . $path];
		User::create($userData);
        return response()->json([
			'status' => 200,
		]);
	}

	// handle edit an user ajax request
	public function edit(Request $request) {
		$id = $request->id;
		$user = User::find($id);
		return response()->json($user);
	}

	// handle update an user ajax request
	public function update(Request $request) {
		// $fileName = '';

		$user = User::find($request->user_id);
		// if ($request->hasFile('avatar')) {
		// 	$file = $request->file('avatar');
		// 	$fileName = time() . '.' . $file->getClientOriginalExtension();
		// 	$file->storeAs('public/images', $fileName);
		// 	if ($user->avatar) {
		// 		Storage::delete('public/images/' . $user->avatar);
		// 	}
		// } else {
		// 	$fileName = $request->user_avatar;
		// }
        $image = $request->file('avatar');
        $name = optional($image)->getClientOriginalName();

        $path = optional($image)->storeAs('uploads', $name, 'public');
		$userData = ['first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email, 'password' => Hash::make($request->password),'bio' => $request->bio, 'avatar' => '/storage/' .$path];
		$user->update($userData);


        return    redirect()->back()->with('message', 'تم تعديل بياناتك الشخصية بنجاح');
	}

}
