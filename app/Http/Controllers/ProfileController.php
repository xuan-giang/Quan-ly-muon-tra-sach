<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use app\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profileView()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('backend.user.view_profile', compact('user'));
    }

    public function profileEdit()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('backend.user.edit_profile', compact('editData'));
    }

    public function profileStore(Request $request)
    {

        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->gender = $request->gender;

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/user_images/' . $data->image));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $data['image'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('profile.view')->with($notification);
    }

    public function passwordView()
    {
        return view('backend.user.edit_password');
    }


    public function passwordUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);


        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            return redirect()->route('login')->with('message', '?????i m???t kh???u th??nh c??ng. Vui l??ng ????ng nh???p l???i');
        } else {
            return redirect()->back()->with('error', 'M???t kh???u hi???n t???i kh??ng ????ng! Vui l??ng nh???p l???i');
        }


    }
}
