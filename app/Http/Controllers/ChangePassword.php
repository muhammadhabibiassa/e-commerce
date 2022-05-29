<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Controller
{
    public function ChangePassword() {
        return view('admin.body.changePassword');
    }

    public function UpdatePassword(Request $request) {

        $validateData = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->current_password,$hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success', 'Password is changed successfully');
        } else {
            return redirect()->back()->with('error', 'Password is not changed successfully');
        }

    }

    public function UpdateProfile() {
        if(Auth::user()){
            $user = User::find(Auth::user()->id);
            if($user){
                return view('admin.body.updateProfile', compact('user'));
            }
        }
    }

    public function UpdateUserProfile(Request $request) {
        $user = User::find(Auth::user()->id);
        if($user){
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->profile_photo_path = $request['profile_photo_path'];

            $old_image = $request->old_image;
            $profile_photo_path = $request->file('profile_photo_path');
            
            if($profile_photo_path) {
                $name_gen = hexdec(uniqid());
                $img_ext = strtolower($profile_photo_path->getClientOriginalExtension());
                $img_name = $name_gen.'.'.$img_ext;
                $up_location = 'image/user/';
                $last_img = $up_location.$img_name;
                $profile_photo_path->move($up_location, $img_name);

                // dd($last_img);

                // unlink($old_image);
                User::find(Auth::user()->id)->update([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'profile_photo_path' => $last_img
                ]);

                return Redirect()->back()->with('success', 'User profile is successfully updated');
            } else {
                User::find(Auth::user()->id)->update([
                    'name' => $request['name'],
                    'email' => $request['email']
                ]);

                return Redirect()->back()->with('success', 'User profile is successfully updated');
            }
        } else {
            return Redirect()->back();
        }
    }
}
