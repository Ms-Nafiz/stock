<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $req)
    {
        // dd($req->email);
        $getUserData = User::where('email', $req->email)->first();

        if ($getUserData) {
            if (Hash::check($req->password, $getUserData->password)) {
                $req->session()->put('login', true);
                $req->session()->put('userId', $getUserData->id);
                return redirect(route('dashboard'));
            } else {
                return back()->with('wrong', 'Wrong Credentials!');
            }
        } else {
            return back()->with('error', 'No Account Found!');
        }
    }
}
