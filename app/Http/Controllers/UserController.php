<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getName()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('admin.body.sidebar',compact('user'));
    }

    public function UserSetup()
    {
        return view('profile.show');
    }
}
